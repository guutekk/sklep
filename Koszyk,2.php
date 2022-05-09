<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location: Logowanie.php ");
    }

    $id_klienta = $_SESSION['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql = "SELECT * FROM carts WHERE Id_klienta = $id_klienta";
    $result = mysqli_query($connect,  $sql);
    if(mysqli_num_rows($result)<1){
        header("Location: Koszyk.php");
    }

?>
<title>Bigibongo Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/koszyk_zamowienie_style.css">
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
        <!--menu-->

    </div>
    <!--stop menu-->
    <section>
        <div class="navigaton-panel">
			<nav>
				<ul>
                    <li><a href="Ustawienia.php"><ion-icon name="cart-outline"></ion-icon> Koszyk</a></li>
                    <li><a href="Ustawienia.php"><ion-icon name="cube-outline"></ion-icon> Transport</a></li>
					<li><a href="Ustawienia_adres.php"><ion-icon name="cash-outline"></ion-icon> Płatność</a></li>
                    <li><a href="Ustawienia_adres.php"><ion-icon name="checkmark-outline"></ion-icon> Podsumowanie</a></li>
				</ul>
			</nav>
 		</div>
         
         <div class="container">
             <form>
                 
             </form>
            <div class="przesylka">
                <h1>Przesyłka: </h1>
                
            </div>
            <div class="adresdostawy">
                    <h1>Siema siema </h1>
            </div>
        </div>
    </section>
    <footer>
			<hr>
			<div class="footer">
				<h2>BIGIBONGOSHOP.COM</h2>
				<p>ul. Marka Ligasa 15</p>
				<p>43-300 Limanowa</p>
				<p>sklep@bigibongo.com</p>
			</div>
		</footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
</body>
</html>