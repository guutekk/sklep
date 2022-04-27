<?php
	//tworzenie sesji
	session_start();
	//laczenie z baza
	$connect=new mysqli('localhost', 'root', '', 'sklep');

	//zapytanie zwracajace 5 ostanich produktow ktore zostaly dodane
	$sql = "SELECT * FROM products ORDER BY Id_produktu DESC LIMIT 5";

	//zapytanie zwracajace 3 losowe produkty
	$sql2 = "SELECT * FROM products ORDER BY RAND() LIMIT 3";

	//zrwacanie true/false zapytania
	$result = mysqli_query($connect, $sql);
	$result1 = mysqli_query($connect, $sql2);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bigibongo Shop</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

		<!--start menu-->
		<div class="navbar">
			
		<!--logo-->
			<div>
				<a href="index.php" class="logo"><ion-icon name="bag"></ion-icon>Bigibongo Shop</a>
			</div>

			<!--menu-->
			<nav>
				<ul>
                    <li><a href="Index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
					<li><a href="Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
					<li><a href="Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
					<li><a href="Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>

					<!--wyswietlanie odpowiednich list z menu do odpowiedniego typu konta (0-user | 1-admin)-->
					<?php

						//sprawdzanie czy uzytkownik jest zalogowany
						if(!isset($_SESSION['user']))
						{
							echo<<<html
								<li><a href="Logowanie.php"><ion-icon name="log-in"></ion-icon> ZALOGUJ SIĘ</a></li>
							html;
						}else{
							//sprawdzanie jaki typ konta posiada uzytkownik jezeli 1 ma sie mu wyswietlic dodatkowa lista w menu
							if($_SESSION['type']==1){
								echo<<<html
									<li><a href="admin/Panel.php"><ion-icon name="lock-open"></ion-icon> PANEL</a></li>
								html;
							}
							echo<<<html
								<li><a><ion-icon name="person"></ion-icon> KONTO</a>
									<ul>
										<li><a href="#"><ion-icon name="cart-outline"></ion-icon> ZAMÓWIENIA</a></li>
										<li><a href="Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
										<li><a href="wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SIĘ</a></li>
									</ul>
								</li>
							html;
						}
					?>	
					</ul>
				</ul>
			</nav>
			<!--menu-->

		</div>
		<!--stop menu-->

		<!--start przesuwanych kafelkow-->
		<section class="home">
			<div class="swiper home-slider">
				<div class="swiper-wrapper wrapper">
					<?php
						//petla do wypisywania ostatnich 5 dodanych rzeczy do bazy
						for($i=0; $i<mysqli_num_rows($result); $i++)
						{
							$row = mysqli_fetch_assoc($result);
							echo<<<html
									<div class="swiper-slide slide">
										<div class="content">
											<span>Nasze nowości</span>
											<h3>$row[Nazwa]</h3>
											<p>$row[Opis]</p>
											<a href="produkt.php?id=$row[Id_produktu]" class="btn">Sprawdź</a>
										</div>
										<div class="image">
											<img src="$row[Id_zdjecia]">
										</div>
									</div>
							html;
						}
					?>	
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</section>
		<!--stop przesuwanych kafelkow-->
		
		<br><br><br><br><br>
		<hr class="hr">
		<br><br><br><br><br>
		<h1 style="text-align: center;">Polecane dla ciebie</h1>
		<div class="grid-container" >
		<?php
					for($i=0; $i<mysqli_num_rows($result1); $i++)
					{
						$row = mysqli_fetch_assoc($result1);
						echo<<<html
						<div class="grid-item">
						<div class="content">
						<div class="image">
						<img src ="$row[Id_zdjecia]">
						<h6>$row[Nazwa]</h6>
						<a href="produkt.php?id=$row[Id_produktu]" class="btn">Zobacz</a>
						</div>
						</div>
						</div>
						html;
					}
			?>
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
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>