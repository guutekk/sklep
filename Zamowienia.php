<?php
session_start();

    $connect=new mysqli('localhost', 'root', '', 'sklep');
    if(!isset($_SESSION['user']))
    {
        header('Location: Logowanie.php');
    }

    $id_klienta = $_SESSION['id'];
    $sql_zamowienie = "SELECT * FROM orders WHERE Id_klienta = $id_klienta";
    $result_zamowienie = mysqli_query($connect, $sql_zamowienie);    

    if(mysqli_num_rows($result_zamowienie)>0){
    }else{
        $error[]= "Brak zamówień! Jeszcze nigdy nic u nas nie zamówiłeś.";
    }
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
    <link rel="stylesheet" href="css/koszyk_style.css">
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
        <div class="cart-container">
            <h1>Twoje zamówienia</h1>
            <br>
            <table>
                <?php
                    if(isset($error)){
                        foreach($error as $error)
                        {
                            echo"
                                <tr>
                                    <td>
                                        <h2>".$error."</h2>
                                    </td>
                                </tr>
                            ";
                        }
                    }else{
                        echo<<<html
                        <tr>
                                <td>
                                    Numer zamówienia
                                </td>
                                <td>
                                    Kwota
                                </td>
                                <td>
                                    Płatność
                                </td>
                                <td>
                                    Dostawa
                                </td>
                                <td>
                                    Data
                                </td>
                                <td>
                                    Status
                                </td>
                                <td>
                                    Szczegóły
                                </td>
                            </tr>
                            <tr>
                        html;
                        for($i=0; $i<mysqli_num_rows($result_zamowienie); $i++)
                        {
                            $row_zamowienie = mysqli_fetch_assoc($result_zamowienie);

                            $sql_platnosc = "SELECT * FROM payments WHERE Id_platnosci = $row_zamowienie[Id_platnosci]";
                            $result_platnosc = mysqli_query($connect, $sql_platnosc);
                            $row_platnosc = mysqli_fetch_assoc($result_platnosc);

                            $sql_dostawa = "SELECT * FROM delivery_method WHERE Id_dostawy = $row_zamowienie[Id_dostawy]";
                            $result_dostawa = mysqli_query($connect, $sql_dostawa);
                            $row_dostawa = mysqli_fetch_assoc($result_dostawa);

                            $sql_status = "SELECT * FROM orders_status WHERE Id_statusu = $row_zamowienie[Id_statusu]";
                            $result_status = mysqli_query($connect, $sql_status);
                            $row_status = mysqli_fetch_assoc($result_status);

                            echo<<<html
                                <td>
                                    $row_zamowienie[Nr_zamowienia]
                                </td>
                                <td>
                                    $row_zamowienie[Cena]
                                </td>
                                <td>
                                    $row_platnosc[Nazwa]
                                </td>
                                <td>
                                    $row_dostawa[Nazwa]
                                </td>
                                <td>
                                    $row_zamowienie[Data_zamowienia]
                                </td>
                                <td>
                                    $row_status[Nazwa]
                                </td>
                                <td>
                                    <form>
                                        <button class='btn'>Zobacz</button>
                                    </form>
                                </td>
                            </tr>
                            html;
                        }
                    }
                ?>
            </table>
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