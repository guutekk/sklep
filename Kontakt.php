<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bigibongo Shop</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Kontaktstyle.css">
</head>
<body>
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
    
    <section>
        <div class="form-container">
            <form action="" method="POST">
                <!-- naglowek -->
                <h3>Formularz kontaktowy</h3>
                <input type="text" name="name" placeholder="Imie i Nazwisko*">
                <input type="text" name="phone" placeholder="Telefon kontakowy">
                <input type="email" name="email" placeholder="Email">
                <textarea type="text" name="tresc" placeholder="Treść"></textarea>
                <input type="submit" name="submit" value="Wyślij zapytanie" class="form-btn">
            </form>
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
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>