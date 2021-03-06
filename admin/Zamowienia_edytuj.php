<?php
	session_start(); 
	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');

	if(isset($_POST['submit_zapisz'])){
		$status = $_POST['status'];
		$id_zamowieniaa = $_POST['id'];
		$sql_insert = "UPDATE orders SET Id_statusu=$status WHERE Id_zamowienia = $id_zamowieniaa";
		mysqli_query($connect, $sql_insert);
		header("Location: Zamowienia.php");
	}

	$id_zamowienia= $_POST['id_zamowienia'];

	$sql = "SELECT * FROM orders WHERE Id_zamowienia = $id_zamowienia";
	$result = mysqli_query($connect, $sql);
	$row= mysqli_fetch_assoc($result);

	$sql_status_zamowienia = "SELECT * FROM orders_status WHERE Id_statusu = $row[Id_statusu]";
	$result_status_zamowienia = mysqli_query($connect, $sql_status_zamowienia);
	$row_status_zamowienia = mysqli_fetch_assoc($result_status_zamowienia);

	$sql_status= "SELECT * FROM orders_status WHERE Id_statusu != $row[Id_statusu]";
	$result_status = mysqli_query($connect, $sql_status);

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
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
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
							<li><a href="../Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAM??WIENIA</a></li>
							<li><a href="../Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
							<li><a href="../wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SI??</a></li>
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
					<li><a href="Uzytkownicy.php"><ion-icon name="reader-outline"></ion-icon> U??ytkownicy</a></li>
					<li><a href="Zamowienia.php"><ion-icon name="reader-outline"></ion-icon> Zam??wienia</a></li>
				</ul>
			</nav>
 		</div>

		 <div class="list-container">
            <h1 style="text-align: center">
                Edytuj zam??wienie
            </h1>
            <br>
            <table id="table">
			<form method='POST'>
                <tr>
                    <td>Numer zam??wienia</td>
                    <td>Data zam??wienia</td>
                    <td>Status</td>
                    <td>Modyfikacje</td>
                </tr>
                <?php
				echo<<<html
					<tr>
					<td>$row[Nr_zamowienia]</td>
					<td>$row[Data_zamowienia]</td>
					<td>
					<select name='status'>
				html;
						echo<<<html
							<option value='$row_status_zamowienia[Id_statusu]'>$row_status_zamowienia[Nazwa]</option>
						html;
						for($i = 0; $i < mysqli_num_rows($result_status); $i++)
						{
							$row_status = mysqli_fetch_assoc($result_status);
							echo"
								<option value='$row_status[Id_statusu]'>$row_status[Nazwa]</option>
							";
						}
				echo<<<html
						</select>
						</td>
						<td>
							<input type='hidden' name='id' value='$row[Id_zamowienia]'>
							<button name='submit_zapisz' class='btn'>Zapisz</button>
						</td>
					</tr>
				html;
                ?>
				</form>
            </table>
		</div>

	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	 <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="js/zamowienia.js"></script>
</body>
</html>