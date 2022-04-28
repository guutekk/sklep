<?php
    session_start();

	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');

	$id_produktu = $_GET['id'];
	$sql = "SELECT * FROM products WHERE Id_produktu = $id_produktu";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);

	$opis = trim($row['Opis'], '\t');
	
	$id_kategorii = $row['Id_kategorii'];

	$sql1 = "SELECT * FROM categories WHERE Id_kategorii=$id_kategorii";
	$result1 = mysqli_query($connect, $sql1);
	$row1 = mysqli_fetch_assoc($result1);

	$sql2 = "SELECT * FROM categories WHERE Id_kategorii!=$id_kategorii";
	$result2 = mysqli_query($connect, $sql2);

	if(isset($_POST['submit'])){
		$nazwa = $_POST['nazwa'];
		$opis = $_POST['opis'];
		$kategoria = $_POST['kategoria'];
		$cena = $_POST['cena'];
		$ilosc = $_POST['ilosc'];
		$zdjecie = $_POST['zdjecie'];

		$sql="UPDATE products SET Nazwa='$nazwa', Opis='$opis',Id_kategorii = '$kategoria',Cena='$cena',Ilosc='$ilosc' WHERE Id_produktu = $id_produktu";
		mysqli_query($connect, $sql);
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
							<li><a href="#"><ion-icon name="cart-outline"></ion-icon> ZAMÓWIENIA</a></li>
							<li><a href="../Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
							<li><a href="../wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SIĘ</a></li>
						</ul>
					</li>	
				</ul>
			</nav>
		</div>

        <div class="form-container">
			<form action="" method="POST">
				<h3>Edytowanie produktu</h3>
				<?php
				echo<<<html
					<input type='text' name='nazwa' value='$row[Nazwa]'>
					<textarea name='opis'>$opis</textarea>
					<select name='kategoria'>
				html;
					echo"<option value='$row1[Id_kategorii]'>$row1[Nazwa]</option>":

				for($i=0; $i<mysqli_num_rows($result2); $i++)
				{
					$row1 = mysqli_fetch_assoc($result2);
					echo<<<html
						<option value="$row1[Id_kategorii]">$row1[Nazwa]</option>
					html;
				}

				echo<<<html
					</select>
					<input type='number' name = 'cena' value='$row[Cena]'>
					<input type='number' name='ilosc' value='$row[Ilosc]'>
					html;
				?>
				<input type="file" multiple name="zdjecie" style="border: 2px solid black">
				<input type="submit" name="submit" value="Edytuj produkt" class="form-btn">
			</form>
		</div>

	</div>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="js/script.js"></script>
</body>
</html>