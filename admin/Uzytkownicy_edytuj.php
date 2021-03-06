<?php
    session_start();

	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');

	$id_klienta = $_GET['id'];
	$sql = "SELECT * FROM accounts WHERE Id_klienta = $id_klienta";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);

	if(isset($_POST['submit'])){
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$email = $_POST['email'];
		$telefon = $_POST['telefon'];

		$sql="UPDATE accounts SET Imie='$imie', Nazwisko='$nazwisko', Email='$email', Telefon='$telefon'WHERE Id_klienta = $id_klienta";
		mysqli_query($connect, $sql);
		header('Location: Uzytkownicy.php');
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
							<li><a href="../Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAM??WIENIA</a></li>
							<li><a href="../Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
							<li><a href="../wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SI??</a></li>
						</ul>
					</li>	
				</ul>
			</nav>
		</div>

        <div class="form-container">
			<form action="" method="POST">
				<h3>Edytowanie <?php echo $row['Imie']?></h3>
				<?php
				echo<<<html
					<input type='text' name='imie' required value='$row[Imie]'>
					<input type='text' name='nazwisko' required value='$row[Nazwisko]'>
					<input type='text' name = 'email' required value='$row[Email]'>
					<input type='number' name='telefon' required value='$row[Telefon]'>
					html;
				?>
				<input type="submit" name="submit" value="Edytuj u??ytkownika" class="form-btn">
				<br>
				<a href="Uzytkownicy.php" class="btn">Powr??t</a>
			</form>
		</div>

	</div>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="js/script.js"></script>
</body>
</html>