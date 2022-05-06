<?php
	session_start(); 
	if (!isset($_SESSION['user'])) {
		header('Location: index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');
	$id_klienta = $_SESSION['id'];

	$sql = "SELECT * FROM accounts_address JOIN provinces USING(Id_wojewodztwa) WHERE Id_klienta = $id_klienta";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);

	if(mysqli_num_rows($result)<1)
	{
		$error = "Dodaj adres zamieszkania!";
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
	<link rel="stylesheet" href="css/ustawienia_style.css">

</head>
<body>
        <div class="navbar">
			<div>
				<a href="index.php" class="logo"><ion-icon name="bag"></ion-icon>Bigibongo Shop</a>
			</div>
			<nav>
				<ul>
                    <li><a href="index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
					<li><a href="Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
					<li><a href="Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
					<li><a href="Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>

					<?php
						if(!isset($_SESSION['user']))
						{
							echo<<<html
								<li><a href="Logowanie.php"><ion-icon name="log-in"></ion-icon> ZALOGUJ SIĘ</a></li>
							html;
						}else{
							if($_SESSION['type']==1){
								echo<<<html
									<li><a href="admin/Panel.php"><ion-icon name="lock-open"></ion-icon> PANEL</a></li>
								html;
							}
							echo<<<html
								<li><a><ion-icon name="person"></ion-icon> KONTO</a>
									<ul>
										<li><a href="Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAMÓWIENIA</a></li>
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
		</div>
        <section>
		<div class="navigaton-panel">
			<nav>
				<ul>
                    <li><a href="Ustawienia.php"><ion-icon name="reader-outline"></ion-icon> Dane konta</a></li>
					<li><a href="Ustawienia_adres.php"><ion-icon name="reader-outline"></ion-icon> Dane Adresowe</a></li>
				</ul>
			</nav>
 		</div>
            <div class="settings-container">
                <h1>Moje dane 
                    <a href="Ustawienia_dane.php">
                        <ion-icon class="ikon" name="create-outline"></ion-icon>
                    </a>
                </h1>
                <br>
                    <table>
                        <tr>
							<?php
								if(isset($error))
								{
									echo"
									<td>
										<a href='Ustawienia_dodaj_zamieszkanie.php' class='btn'>Dodaj dane adresowe</a><br>							
									</td>
									</tr>";
								}else{
								echo<<<html
									<tr>
										<td>Ulica</td>
										<td>
											<b>$row[Ulica]</b>
										</td>
									</tr>
									<tr>
										<td>Nr. budynku</td>
										<td>
											<b>$row[Nr_budynku]</b>
										</td>
									</tr>
									<tr>
										<td>Kod pocztowy</td>
										<td>
											<b>$row[Kod_pocztowy]</b>
										</td>
									</tr>
									<tr>
										<td>Miasto</td>
										<td>
											<b>$row[Miasto]</b>
										</td>
									</tr>
									<tr>
										<td>Wojewodztwo</td>
										<td>
											<b>$row[Nazwa]</b>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<a href="Ustawienia_edytuj_zamieszkanie.php" class="btn">Edytuj dane</a><br>
										</td>
									</tr>
									html;
								}
							?>
                    </table>
            </div>
        </section>

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