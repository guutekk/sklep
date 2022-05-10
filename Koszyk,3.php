<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location: Logowanie.php ");
    }

    $id_klienta = $_SESSION['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql = "SELECT *, o.Cena as Cena_zamowienia , d.Nazwa as Nazwa_dostawa, d.Cena as Cena_dostawa, p.Nazwa as Nazwa_platnosc, p.Cena as Cena_platnosc FROM orders o JOIN delivery_method d USING(Id_dostawy) JOIN payments p USING(Id_platnosci) WHERE Id_klienta=$id_klienta AND Id_Statusu=0";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);


    if(isset($_POST['submit']))
    {
        header("Location: cos.php");
    }
?>
<title>Bigibongo Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
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
                    <li><a href="Koszyk.php"><ion-icon name="cart-outline"></ion-icon> Koszyk</a></li>
                    <li><a href="Koszyk,2.php"><ion-icon name="cube-outline"></ion-icon> Płatność / Dostawa</a></li>
                    <li><a href="Koszyk,3.php"><ion-icon name="checkmark-outline"></ion-icon> Podsumowanie</a></li>
				</ul>
			</nav>
 		</div>
         
         <form method="POST">
         <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Dane adresowe:</h4>
                        <table class='delivery'>
                            <tr>
                                <td>
                                    Transport
                                </td>
                                <td>
                                    <?php
                                        echo $row['Nazwa_dostawa'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Imie Nazwisko
                                </td>
                                <td>
                                    <?php
                                        echo $_SESSION['user']." ".$_SESSION['nazwisko'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Adres
                                </td>
                                <td>
                                    <?php
                                        echo $row['Ulica']." ".$row['Nr_budynku'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Miasto
                                </td>
                                <td>
                                <?php
                                        echo $row['Kod_pocztowy']." ".$row['Miasto'];
                                    ?>
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    Telefon
                                </td>
                                <td>
                                    <?php
                                        echo $_SESSION['telefon'];
                                    ?>
                                </td>
                            </tr>  
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <?php
                                        echo $_SESSION['email'];
                                    ?>
                                </td>
                            </tr>   
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>Podsumowanie:</h4>
                        <table>
                            <tr>
                                <td>
                                    <?php
                                        echo $row['Nazwa_platnosc'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $row['Cena_platnosc'].",00zł";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cena dostawy
                                </td>
                                <td>
                                    <?php
                                        echo $row['Cena_dostawa'].",00zł";
                                    ?>
                                </td>
                            </tr>
                                <td>
                                    Brutto
                                </td>
                                <td>
                                    
                                </td>
                            <tr>
                                <td>
                                    Do zapłaty
                                </td>
                                <td>
                                    <?php
                                        echo $row['Cena_zamowienia'].",00zł";
                                    ?>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <form method="POST">
                        <button name='submit' class='btn'>Zamawiam i płacę</button>
                    </form>
                </div>
            </div>
         </form>
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