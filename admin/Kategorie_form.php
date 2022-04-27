<?php
    session_start();
    $connect=new mysqli('localhost', 'root', '', 'sklep');
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($connect, $sql);

    if (!isset($_SESSION['user']) && !isset($_SESSION['nazwisko']) && !isset($_SESSION['email']) && !isset($_SESSION['haslo']) && !isset($_SESSION['telefon'])) {
		header('Location: ../index.php');
	}else{
        if(!$_SESSION['type']==1)
		{
			header('Location: ../index.php'); 
		}else{


            if(isset($_POST['submit'])){
                $nazwa = $_POST['nazwa'];
                $zdjecie = $_POST['zdjecie'];

                $query="INSERT INTO categories(Nazwa, Zdjecie) VALUES ('$nazwa', 'images/$zdjecie')";
                $connect->query($query);
				header('Location: Panel.php');
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
			<h3>Dodawanie kategorii</h3>
            <?php 
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error">'.$error.'</span>';
                    };
                };
            ?>
            <input type="text" name="nazwa" required placeholder="Nazwa kategorii">
    		<input type="file" name="zdjecie" style="border: 2px solid black">
			<input type="submit" name="submit" value="Dodaj produkt" class="form-btn">
			</form>
		</div>

	</div>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="js/script.js"></script>
</body>
</html>
<?php
    }
}
?>