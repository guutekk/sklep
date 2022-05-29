<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location: Logowanie.php ");
    }

    $id_klienta = $_SESSION['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql_koszyk = "SELECT c.Ilosc, c.Id_klienta, c.Id_produktu, p.Ilosc prilosc, p.Nazwa, p.Cena FROM carts c JOIN products p USING(Id_produktu) WHERE c.Id_klienta = $id_klienta AND c.Status = 0";
    $result_koszyk = mysqli_query($connect, $sql_koszyk);

    $cena_suma = 0;
    for($i=0; $i<mysqli_num_rows($result_koszyk); $i++)
    {
        $row = mysqli_fetch_assoc($result_koszyk);
        $ilosc = $row['Ilosc'];
        $cena = $row['Cena'];

        if($ilosc>1)
        {
            $cena*=$ilosc;
        }

        $cena_suma+=$cena;


    }


    $id_dostawy = $_POST['radio_dostawa'];
    $id_platnosci = $_POST['radio_platnosc'];

    $sql_dostawa = "SELECT * FROM delivery_method WHERE Id_dostawy = $id_dostawy";
    $result_dostawa = mysqli_query($connect, $sql_dostawa);
    $row_dostawa = mysqli_fetch_assoc($result_dostawa);

    $sql_platnosc = "SELECT * FROM payments WHERE Id_platnosci = $id_platnosci";
    $result_platnosc = mysqli_query($connect, $sql_platnosc);
    $row_platnosc = mysqli_fetch_assoc($result_platnosc);

    $ulica = $_POST['ulica'];
    $nr_budynku = $_POST['nr_budynku'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $miasto = $_POST['miasto'];
    $id_wojewodztwa = $_POST['wojewodztwo'];

    $suma = $cena_suma + $row_dostawa['Cena'] + $row_platnosc['Cena'];


    if(isset($_POST['submit_order'])){
        $data = date("Y-m-d");
        $nr_zamowienia = rand(10000, 99999);
        $id_dostawy = $_POST['radio_dostawa'];
        $id_platnosci = $_POST['radio_platnosc'];
        $ulica = $_POST['ulica'];
        $nr_budynku = $_POST['nr_budynku'];
        $kod_pocztowy = $_POST['kod_pocztowy'];
        $miasto = $_POST['miasto'];
        $id_wojewodztwa = $_POST['wojewodztwo'];

        $sql_insert = "INSERT INTO orders (Id_klienta, Id_dostawy, Id_platnosci, Data_zamowienia, Cena, Ulica, Nr_budynku, Kod_pocztowy, Miasto, Id_wojewodztwa,Id_statusu, Nr_zamowienia) 
        VALUES ('$id_klienta','$id_dostawy','$id_platnosci','$data','$suma','$ulica','$nr_budynku','$kod_pocztowy','$miasto','$id_wojewodztwa', '1', '$nr_zamowienia')";
        mysqli_query($connect, $sql_insert);

        $sql_cart = "UPDATE carts SET `Status`=1 , Nr_zamowienia = $nr_zamowienia WHERE `Status` = 0 AND Id_klienta = $id_klienta AND Nr_zamowienia =0";
        mysqli_query($connect, $sql_cart);

        header("Location: Zamowienie.php");
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
        <?php
            echo<<<html
                <input type='hidden' name='ulica' value='$ulica'>
                <input type='hidden' name='nr_budynku' value='$nr_budynku'>
                <input type='hidden' name='kod_pocztowy' value='$kod_pocztowy'>
                <input type='hidden' name='miasto' value='$miasto'>
                <input type='hidden' name='wojewodztwo' value='$id_wojewodztwa'>
                <input type='hidden' name='radio_platnosc' value='$id_platnosci'>
                <input type='hidden' name='radio_dostawa' value='$id_dostawy'>
            html;
        ?>
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
                                        echo $row_dostawa['Nazwa'];
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
                                        echo $ulica." ".$nr_budynku;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Miasto
                                </td>
                                <td>
                                <?php
                                        echo $kod_pocztowy." ".$miasto;
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
                                        echo $row_platnosc['Nazwa'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $row_platnosc['Cena'].",00zł";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cena dostawy
                                </td>
                                <td>
                                    <?php
                                        echo $row_dostawa['Cena'].",00zł";
                                    ?>
                                </td>
                            </tr>
                                <td>
                                    Brutto
                                </td>
                                <td>
                                    <?php
                                        echo $cena_suma.",00zł";
                                    ?>
                                </td>
                            <tr>
                                <td>
                                    Do zapłaty
                                </td>
                                <td>
                                    <?php
                                        echo $suma.",00zł";
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <button class='btn' name='submit_order'>Zamawiam i płacę</button>
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
    <script src="js/koszyk_script.js"></script>
</body>
</html>