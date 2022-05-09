<?php
	session_start(); 
	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($connect, $sql);

	if(isset($_POST['submit_usun']))
	{
		$id_kategorii = $_POST['id_kategorii'];
		$sql = "DELETE FROM categories WHERE Id_kategorii = $id_kategorii";
		mysqli_query($connect, $sql);
		header("Location: Kategorie.php");
	}

	if(isset($_POST['submit_edycja']))
	{
		$id_kategorii = $_POST['id_kategorii'];
		header("Location: Kategorie_edytuj.php?id=$id_kategorii");
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
	<link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
	<link rel="stylesheet" href="css/style.css">

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
		<br><br><br>
		<div class="navigaton-panel">
			<nav>
				<ul>
                    <li><a href="Panel.php"><ion-icon name="home-outline"></ion-icon> Home</a></li>
					<li><a href="Produkty.php"><ion-icon name="reader-outline"></ion-icon> Produkty</a></li>
					<li><a href="Kategorie.php"><ion-icon name="reader-outline"></ion-icon> Kategorie</a></li>
					<li><a href="Uzytkownicy.php"><ion-icon name="reader-outline"></ion-icon> Uzytkownicy</a></li>
					<li><a href="Zamowienia.php"><ion-icon name="reader-outline"></ion-icon> Zamówienia</a></li>
				</ul>
			</nav>
 		</div>
		 <div class="list-container">
			<h1 style="text-align: center">
				Lista kategorii<br>
				<a href='Kategorie_dodaj.php' class="btn">Dodaj kategorie</a>
			</h1>
			<br>
			<table>
				<tr>
					<td>Id</td>
					<td>Nazwa</td>
					<td>Modyfikacje</td>
				</tr>
				<?php
					for($i=0; $i<mysqli_num_rows($result); $i++)
					{
						$row = mysqli_fetch_assoc($result);
						echo
						"<tr>
							<td>$row[Id_kategorii]</td>
							<td>$row[Nazwa]</td>
							<td>
							<form method='POST'>
								<input type='hidden' name='id_kategorii' value='$row[Id_kategorii]'>
								<button name='submit_edycja' class='btn'>Edytuj</button>	<br>
								<button name='submit_usun' class='btn'>Usuń</button>
							</form>
							</td>
						</tr>";
					}
				?>
			</table>
		</div>
	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	 <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>