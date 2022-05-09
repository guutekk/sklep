<?php

	//tworzenie sesji
	session_start(); 

	//laczenie z baza
	$connect=new mysqli('localhost', 'root', '', 'sklep');

	//logowanie do konta
	if(isset($_POST['submit'])){
		
		//przypisywanie do zmiennych wartosci z pol formularza
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		//email z malych oraz kodowanie hasla
		$email = strtolower($email);
		$pass= md5($pass);
	
		//zapytanie zwracajace konto z podanymi danymi
		$sql = "SELECT * FROM accounts WHERE Email='$email' AND Haslo='$pass'";
	
		//zrwacanie true/false zapytania
		$result = mysqli_query($connect, $sql);
	
		//sprawdzanie czy zapytanie zwrocilo wiecej niz 0 wieszy
		if (mysqli_num_rows($result) > 0) {
			
			//zwracanie rekordow w postaci tablicy asocjacyjnej 
			$row = mysqli_fetch_assoc($result);

			//sprawdzanie czy dane z formularza zgadzaja sie z danymi z bazy
			if ($row['Email'] == $email && $row['Haslo'] == $pass) {

				//przechowywanie w zmiennych zarejestrowanych podczas logowania danych uzytkownika
				$_SESSION['id'] = $row['Id_klienta'];
				$_SESSION['type'] = $row['Type'];
				$_SESSION['user'] = $row['Imie'];
				$_SESSION['nazwisko'] = $row['Nazwisko'];
				$_SESSION['email'] = $row['Email'];
				$_SESSION['telefon'] = $row['Telefon'];
				$_SESSION['haslo'] = $row['Haslo'];

				//przerzucenie do strony glownej
				header('Location: index.php');
	
			}
		}else{

			//zapisywanie do tablicy bledow jakie napodkaly podczas logowania
			$error[]= 'Emial lub hasło jest błedne!';
		}
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
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
		<!-- start menu -->
		<div class="navbar">

			<!-- logo -->
			<div>
				<a href="index.php" class="logo"><ion-icon name="bag"></ion-icon>Bigibongo Shop</a>
			</div>

			<!-- menu -->
			<nav>
				<ul>
                    <li><a href="index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
					<li><a href="Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
					<li><a href="Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
					<li><a href="Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>
					<li><a href="Logowanie.php"><ion-icon name="log-in"></ion-icon> ZALOGUJ SIĘ</a></li>
				</ul>
			</nav>
			<!-- menu -->

		</div>
		<!-- stop menu -->

		<!-- start formularza logowania -->
		<div class="form-container">

			<!-- formularz -->
			<form action="" method="POST">
			<!-- naglowek -->
			<h3>Logowanie do konta</h3>
			<!-- wyswietlanie errorow jezeli tak owe wystapia -->
			<?php 
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error">'.$error.'</span>';
                    };
                };
            ?>

			<!-- pola formularza -->
			<input type="email" name="email" required placeholder="Email">
			<input type="password" name="pass" required placeholder="Hasło">
			<input type="submit" name="submit" value="Zaloguj się" class="form-btn">
			
			<!-- odnosnik do resetowania hasla -->
			<p><a href="#">Nie pamiętasz hasła?</a></p>

			<!-- rejestracja -->
			<h3>Nie masz jeszcze konta?</h3>
			<p>Rejestracja zajmie Ci tylko kilka minut!</p>
			<a href="Rejestracja.php" class="form-btn">Zarejestruj się</a>
			</form>
			<!-- formularz -->

		</div>
		<!-- stop formularza logowania -->


		<footer>
			<hr>
			<div style="text-align: center; padding-bottom:30px;">
				<h2 class ="contact-h2">BIGIBONGOSHOP.COM</h2>
				<p class ="contact-p">ul. Marka Ligasa 15</p>
				<p class ="contact-p">43-300 Limanowa</p>
				<p class ="contact-p">sklep@bigibongo.com</p>
			</div>
		</footer>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="js/script.js"></script>
</body>
</html>