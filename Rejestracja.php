<?php

	//tworzenie sesji
	session_start(); 

	//laczenie z baza
	$connect=new mysqli('localhost', 'root', '', 'sklep');

	//rejestracja konta
	if(isset($_POST['submit'])){

		//przypisywanie do zmiennych wartosci z pol formularza
		$name = $_POST['imie'];
		$lastname = $_POST['nazwisko'];
		$email = $_POST['email'];
		$tel = $_POST['tel']; 
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];

		//email z malych oraz kodowanie hasla
		$email = strtolower($email);
		$pass= md5($pass);
		$cpass =md5($cpass);

		//zapytanie zwracajace konto z podanymi danymi
		$sql = "SELECT * FROM accounts WHERE Email='$email'";
		$sql1 = "SELECT * FROM accounts WHERE Telefon='$tel'";

		//zrwacanie true/false zapytania
		$result = mysqli_query($connect, $sql);
		$result1 = mysqli_query($connect, $sql1);
		
		//sprawdzanie czy zapytanie zwrocilo wiecej niz 0 wieszy
		if(mysqli_num_rows($result) > 0){
			
			//zapisywanie do tablicy bledow jakie napodkaly podczas rejestracji
			$error[] = 'Jest już konto z tym adresem email';
			
		//sprawdzanie czy zapytanie zwrocilo wiecej niz 0 wieszy	
		}else if(mysqli_num_rows($result1) > 0){

			//zapisywanie do tablicy bledow jakie napodkaly podczas rejestracji
			$error[] = 'Jest już konto z tym numerem telefonu';

		}else{

			//sprawdzanie czy hasla podane w formularzu sa takie same
			if($pass!=$cpass){

				//zapisywanie do tablicy bledow jakie napodkaly podczas rejestracji
				$error[]='Hasła się nie zgadzają';

			}else{

				//dodawnie do bazy uzywkonika
				$query ="INSERT INTO accounts(Imie, Nazwisko, Email,Telefon, Haslo) VALUES ('$name','$lastname','$email','$tel','$pass')";

				//laczenie z baza i wysywanie zapytania
				$connect->query($query);

				//przerzucenie do strony logowania
				header('Location: Logowanie.php');
			}
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


		<!-- start formularza rejestracji -->
		<div class="form-container">

			<!-- formularz -->
			<form action="" method="POST">
			<!-- naglowek -->
			<h3>Rejestracja konta</h3>
			<!-- wyswietlanie errorow jezeli tak owe wystapia -->
            <?php 
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error">'.$error.'</span>';
                    };
                };
            ?>

			<!-- pola formularza -->
            <input type="text" name="imie" minlength="3" required placeholder="Imie">
            <input type="text" name="nazwisko" minlength="3" required placeholder="Nazwisko">
			<input type="email" name="email" required placeholder="Email">
			<input type="text" name = "tel" minlength="9" maxlength="9" placeholder="Telefon">
			<input type="password" name="pass" minlength="6" required placeholder="Hasło">
			<input type="password" name="cpass" minlength="6" required placeholder="Powtórz Hasło">
			<input type="submit" name="submit" value="Zarejestruj się" class="form-btn">

			<!-- logowanie -->
			<h3>Masz już konto?</h3>
			<p>Zaloguj się natychmiast!</p>
			<a href="Logowanie.php" class="form-btn">Zaloguj się</a>
			</form>
			<!-- formularz -->

		</div>
		<!-- start formularza rejestracji -->
	</div>

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