<?php

    session_start();

    $id_produktu = $_GET['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql_produkt = "SELECT * FROM products WHERE Id_produktu = $id_produktu";
    $result_produkt = mysqli_query($connect, $sql_produkt);
    $row_produkt = mysqli_fetch_assoc($result_produkt);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bigibongo Shop</title>
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
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <h1>Zdjecia dla 
                        "
                        <?php
                            echo $row_produkt['Nazwa'];
                        ?>
                        "
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">ad</div>
                <div class="col-md-3">asd</div>
                <div class="col-md-3">asd</div>
                <div class="col-md-3">asd</div>
            </div>
        </div>
        </section>
</body>
</html>