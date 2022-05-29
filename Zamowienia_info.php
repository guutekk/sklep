<?php

    session_start();
    $id_zamowienia = $_POST['id'];

    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql_zamowienie= "SELECT * FROM orders WHERE Id_zamowienia = $id_zamowienia";
    $result_zamowienie = mysqli_query($connect, $sql_zamowienie);
    $row_zamowienie = mysqli_fetch_assoc($result_zamowienie);

    $sql_koszyk = "SELECT c.Ilosc, c.Id_klienta,c.Id_produktu, p.Nazwa, p.Cena FROM carts c JOIN products p USING(Id_produktu) WHERE Id_klienta = $row_zamowienie[Id_klienta] AND `Status` = 1 AND Nr_zamowienia = $row_zamowienie[Nr_zamowienia]";
    $result_koszyk = mysqli_query($connect, $sql_koszyk);

    $sql_uzytkownik = "SELECT * FROM accounts WHERE Id_klienta = $row_zamowienie[Id_zamowienia]";
    $result_uzytkownik = mysqli_query($connect, $sql_uzytkownik);
    $row_uzytkownik = mysqli_fetch_assoc($result_uzytkownik);

    $sql_dostawa = "SELECT * FROM delivery_method WHERE Id_dostawy = $row_zamowienie[Id_dostawy]";
    $result_dostawa = mysqli_query($connect, $sql_dostawa);
    $row_dostawa = mysqli_fetch_assoc($result_dostawa);

    $sql_platnosc = "SELECT * FROM payments WHERE Id_platnosci = $row_zamowienie[Id_platnosci]";
    $result_platnosc = mysqli_query($connect, $sql_platnosc);
    $row_platnosc = mysqli_fetch_assoc($result_platnosc);

    $sql_status = "SELECT * FROM orders_status WHERE Id_statusu = $row_zamowienie[Id_statusu]";
    $result_status = mysqli_query($connect, $sql_status);
    $row_status = mysqli_fetch_assoc($result_status);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bigibongo Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/zamowienia_info.css">
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
    <div class="container" id='info'>
        <h3>
            Zamówienie numer
            <?php
                echo $row_zamowienie['Nr_zamowienia'];
            ?>
            <br>
            <?php
                if(isset($info)){
                    echo "<a href='Uzytkownik_info.php?id=$id_uzytkownika' class='btn'>Powrót</a>";
                }else{

                   echo "<a href='Zamowienia.php' class='btn'>Powrót</a>";
                }
            ?>
            <button class='btn' id='zobacz' onclick='show_cart()'>Zamówione przedmioty</button>
        </h3>
            <div class="row">
                <div class="col-md-6">
                    <h4>Dane adresowe:</h4>
                    <table class='delivery'>
                        <tr>
                            <td>
                                Imie Nazwisko
                            </td>
                            <td>
                                <?php
                                    echo $row_uzytkownik['Imie']." ".$row_uzytkownik['Nazwisko'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Adres
                            </td>
                            <td>
                                <?php
                                    echo $row_zamowienie['Ulica']." ".$row_zamowienie['Nr_budynku'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Miasto
                            </td>
                            <td>
                            <?php
                                    echo $row_zamowienie['Kod_pocztowy']." ".$row_zamowienie['Miasto'];
                                ?>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                Telefon
                            </td>
                            <td>
                                <?php
                                    echo $row_uzytkownik['Telefon'];
                                ?>
                            </td>
                        </tr>  
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <?php
                                    echo $row_uzytkownik['Email'];
                                ?>
                            </td>
                        </tr>   
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Pozostałe</h4>
                        <table>
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
                                <td>Płatność</td>
                                <td>
                                    <?php
                                        echo $row_platnosc['Nazwa'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <?php
                                        echo $row_status['Nazwa'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cena
                                </td>
                                <td>
                                    <?php
                                        echo $row_zamowienie['Cena'].",00zł";
                                    ?>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
        <div class="container" id='koszyk'>
        <div class="row">
            <h4>Zamówione przedmioty</h4>
            <?php
                if(isset($info)){
                    echo "<a href='Uzytkownik_info.php?id=$id_uzytkownika' class='btn'>Powrót</a>";
                }else{

                   echo "<a href='Zamowienia.php' class='btn'>Powrót</a>";
                }
            ?>
            <button class='btn' id='anuluj' onclick='hide_cart()'>Cofnij</button>
                <div class="col-xs-12">
                    <table class="carts">
                        <?php
                            for($i=0; $i<mysqli_num_rows($result_koszyk); $i++)
                            {
                                $row = mysqli_fetch_assoc($result_koszyk);

                                $sql_zdjecie = "SELECT * FROM images WHERE Id_produktu= $row[Id_produktu]"; 
                                $result_zdjecie= mysqli_query($connect, $sql_zdjecie);
                                $row_zdjecie  = mysqli_fetch_assoc($result_zdjecie);
                                $imageURL = 'images/'.$row_zdjecie['Nazwa_pliku'];
                                echo<<<html
                                    <tr> 
                                        <td>
                                            <a href='produkt.php?id=$row[Id_produktu]'>
                                                <img src='$imageURL'>
                                            </a>
                                        </td>
                                        <td>
                                            <h5>$row[Nazwa]</h5>
                                        </td>
                                        <td>
                                            <h5>Ilość: $row[Ilosc]</h5>
                                        </td>
                                        <td>
                                            <h5>Cena: $row[Cena]zł</h5>
                                        </td>
                                    </tr>
                                html;
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="admin/js/zamowienia.js"></script>
</body>
</html>