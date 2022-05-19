<?php
    session_start();

	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($connect, $sql);

	if(isset($_POST['submit'])){
		$nazwa = $_POST['nazwa'];
		$opis = $_POST['opis'];
		$kategoria = $_POST['kategoria'];
		$cena = $_POST['cena'];
		$ilosc = $_POST['ilosc'];

		$sql_produkt="INSERT INTO products(Nazwa, Opis, Id_kategorii, Cena, Ilosc) VALUES ('$nazwa','$opis','$kategoria','$cena','$ilosc')";
		mysqli_query($connect, $sql_produkt);


		$targetDir = "../images/"; 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		$insertValuesSQL = "";
		
		$fileNames = array_filter($_FILES['files']['name']); 
		if(!empty($fileNames)){ 
			foreach($_FILES['files']['name'] as $key=>$val){ 
				// File upload path 
				$fileName = basename($_FILES['files']['name'][$key]); 
				$targetFilePath = $targetDir . $fileName; 
				
				$sql_id_produktu = "SELECT * FROM products ORDER BY Id_produktu DESC";
				$result_id_produktu = mysqli_query($connect, $sql_id_produktu);
				$row_id_prodktu = mysqli_fetch_assoc($result_id_produktu);
				$id_produktu = $row_id_prodktu['Id_produktu'];

				// Check whether file type is valid 
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
				if(in_array($fileType, $allowTypes)){ 
					// Upload file to server 
					if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
						// Image db insert sql 
						$insertValuesSQL .= "('".$fileName."', NOW(), '".$id_produktu."'),";
					}
				}
			} 

			if(!empty($insertValuesSQL)){ 
				$insertValuesSQL = trim($insertValuesSQL, ','); 
				// Insert image file name into database 
            	$insert = $connect->query("INSERT INTO images (Nazwa_pliku, uploaded_on, Id_produktu) VALUES $insertValuesSQL"); 
			}
		} 
			header('Location: Produkty.php');
	}
 ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bigibongo Shop</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="full-page">
		<div class="navbar">
			<div>
				<a href="../index.php" class="logo"><ion-icon name="bag"></ion-icon>Bigibongo Shop</a>
			</div>
			<nav>
				<ul>
                    <li><a href="../index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
					<li><a href="../Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
					<li><a href="../Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
					<li><a href="../Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>

					<?php
						if(isset($_SESSION['user']))
						{
							echo<<<html
								<li><a href="Panel.php"><ion-icon name="lock-open"></ion-icon> PANEL</a></li>
							html;
						}
					?>
					<li><a><ion-icon name="person"></ion-icon> KONTO</a>
						<ul>
							<li><a href="../Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAMÓWIENIA</a></li>
							<li><a href="../Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
							<li><a href="../wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SIĘ</a></li>
						</ul>
					</li>	
				</ul>
			</nav>
		</div>

        <div class="form-container">
			<form method="POST" enctype="multipart/form-data">
				<h3>Dodawanie produktu</h3>
				<input type="text" name="nazwa" required placeholder="Nazwa produktu">
				<textarea name="opis" required placeholder="Opis"></textarea>
				<select name="kategoria" required>
					<?php
						for($i=0; $i<mysqli_num_rows($result); $i++)
						{
							$row = mysqli_fetch_assoc($result);
							echo<<<html
								<option value="$row[Id_kategorii]">$row[Nazwa]</option>
							html;
						}
					?>
				</select>
				<input type="number" name = "cena" required placeholder="Cena">
				<input type="number" name="ilosc" required placeholder="Ilość">
				<input type="file" name="files[]" required multiple style="border: 2px solid black">
				<input type="submit" name="submit" value="Dodaj produkt" class="form-btn">
				<br>
				<a href="Produkty.php" class="btn">Powrót</a>
			</form>
		</div>

	</div>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="js/script.js"></script>
</body>
</html>