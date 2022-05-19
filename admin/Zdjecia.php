<?php

    session_start();

	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

    $id_produktu = $_GET['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql_produkt = "SELECT * FROM products WHERE Id_produktu = $id_produktu";
    $result_produkt = mysqli_query($connect, $sql_produkt);
    $row_produkt = mysqli_fetch_assoc($result_produkt);

	$sql_zdjecia = "SELECT * FROM images WHERE Id_produktu =$id_produktu";
	$result_zdjecia = mysqli_query($connect, $sql_zdjecia);

	if(mysqli_num_rows($result_zdjecia)<1){
		$error[]="Ten produkt nie ma dodanych zdjęć!";
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
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" href="css/zdjecia.css">
</head>
<body>

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

        <section>
        <div class="container">
			<h1>Produkt <?php echo $row_produkt['Nazwa']?> 
				<a href="Produkty.php" class="btn-back">Powrót</a>
			</h1>
        </div>
		
		<br><br>	
		<div class="container" id="photo">
			<div class="row">
				<h2>
					Zdjęcia &nbsp
					<button class="btn-add-form" onclick="show_form()" name="add">Dodaj zdjęcia</button>
				</h2>
				<?php
					if(isset($error)){
						foreach($error as $error){
							echo<<<html
								<h3>$error</h3>
							html;
						}
					}else{
						for($i=0; $i<mysqli_num_rows($result_zdjecia); $i++){
							$row = mysqli_fetch_assoc($result_zdjecia);
							$imageURL = $row['Nazwa_pliku'];						
							echo<<<html
								<div class="col-md-4">
									<img src='../images/$imageURL'/>
									<form method="POST" action="Zdjecia_modyfikacje.php">
										<input type='hidden' name='id_produktu' value='$id_produktu'>
										<input type='hidden' name='id_zdjecia' value='$row[Id_zdjecia]'>
										<button class='btn' name='submit_usun'>Usuń</button>
									</form>
									<button class="btn" id='$row[Id_zdjecia]' onclick="show_form_edit(this.id)">Edytuj</button>
								</div>
							html;
						}
					}
				?>
			</div>
		</div>

		<div class="container form" id="form">
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<h2>
						Dodaj zdjęcie &nbsp
					<button class="btn-add-form" onclick="hide_form()" name="cancel">Anuluj</button>
					</h2>
					<form method="POST" action="Zdjecia_modyfikacje.php" enctype="multipart/form-data">
						<?php
							echo"<input type='hidden' name='id_produktu' value='$row_produkt[Id_produktu]'>";
						?>
						<input type="file" name="files[]" required multiple>
						<br>
						<button class="btn-add-form" name="submit_dodaj">Dodaj</button>
					</form>
				</div>
			</div>
		</div>

		<div class="container form" id="form-edit">
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<h2>
						Edytuj zdjęcie &nbsp
					<button class="btn-add-form" onclick="hide_form_edit()" name="cancel">Anuluj</button>
					</h2>
					<form method="POST" action="Zdjecia_modyfikacje.php" enctype="multipart/form-data">
						<?php
							echo"
							<input type='hidden' name='id_produktu' value='$row_produkt[Id_produktu]'>
							";
						?>
						<input type='hidden' name='id_zdjecia' id='id_zdjecia'>
						<input type="file" name="files[]" required multiple>
						<br>
						<button class="btn-add-form" name="submit_edytuj">Edytuj</button>
					</form>
				</div>
			</div>
		</div>



        </section>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>