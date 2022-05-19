<?php
    session_start();

	if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}
	
	$connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql = "SELECT * FROM accounts WHERE Id_klienta = $_GET[id]";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql_adres = "SELECT * FROM accounts_address WHERE Id_klienta = $_GET[id]";
    $result_adres = mysqli_query($connect, $sql_adres);
    $row_adres = mysqli_fetch_assoc($result_adres);

    if(mysqli_num_rows($result_adres)<1){
        $error[] = "Ten użytkownik nie dodaj adresu zamieszkania";
    }else{
        $sql_wojewodztwo = "SELECT * FROM provinces WHERE Id_wojewodztwa = $row_adres[Id_wojewodztwa]";
        $result_woj = mysqli_query($connect, $sql_wojewodztwo);
        $row_woj = mysqli_fetch_assoc($result_woj);
    }


    $sql_zam = "SELECT * FROM orders WHERE Id_klienta =$_GET[id]";
    $result_zam = mysqli_query($connect, $sql_zam);
    $row_zam = mysqli_fetch_assoc($result_zam);

    if(mysqli_num_rows($result_zam)<1){
        $error1[]="Ten użytkownik jeszcze nic nie zamówił!";
    }else{
        
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
	<link rel="stylesheet" href="css/user_info.css">

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
    <div class="container" id="info">
        <h2>
            <?php
                echo "Informacje o użytkowniku $row[Imie] $row[Nazwisko]";
            ?>
            <br>
            <a class="btn" href="Uzytkownicy.php">Powrót</a>
            <button class="btn" onclick="show_order()">Zobacz zamówienia</button>
        </h2>
        <div class="row">
            <div class="col-md-5">
                <h3>Informacje ogólne</h3>
                    <table>
                        <tr>
                            <td>Imie i nazwisko</td>
                            <td>
                                <?php
                                    echo "$row[Imie] $row[Nazwisko]";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <?php
                                    echo "$row[Email]";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nr. telefonu
                            </td>
                            <td>
                                <?php
                                    echo "$row[Telefon]";
                                ?>
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="col-md-7">
            <h3>Informacje adresu</h3>
                <table>
                    <?php
                        if(isset($error)){
                            foreach($error as $error){
                                echo"<h4>$error<h4>";
                            }
                        }else{
                            echo<<<html
                                <table>
                                    <tr>
                                        <td>
                                            Ulica
                                        </td>
                                        <td>
                                            $row_adres[Ulica]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nr. budynku
                                        </td>
                                        <td>
                                            $row_adres[Nr_budynku]
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        Kod pocztowy
                                    </td>
                                    <td>
                                        $row_adres[Kod_pocztowy]
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Miasto
                                        </td>
                                        <td>
                                            $row_adres[Miasto]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        Miasto
                                        </td>
                                        <td>
                                            $row_adres[Miasto]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Województwo
                                        </td>
                                        <td>
                                            $row_woj[Nazwa]
                                        </td>
                                    </tr>
                                </table>
                            html;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="container" id="order">
    <h2>
        <?php
                echo "Zamówienia $row[Imie] $row[Nazwisko]";
        ?>
        <br>
        <a class="btn" href="Uzytkownicy.php">Powrót</a>
        <button class="btn" onclick="hide_order()">Cofnij</button>
    </h2>
        <div class="row">
            <div class="col-xs-12">
                <?php
                    if(isset($error1)){
                        foreach($error1  as $error1){
                            echo"<h2>$error1<h2>";
                        }
                    }else{
                        echo<<<html
                        <table>
                        <tr>
                            <td>Dostawa</td>
                            <td>Płatność</td>
                            <td>Data zamówienia</td>
                            <td>Cena</td>
                            <td>Ilość</td>
                            <td>Status</td>
                            <td>Zarządzaj</td>
                        </tr>
                        <tr>
                            <td>Dostawa</td>
                            <td>Płatność</td>
                            <td>Data zamówienia</td>
                            <td>Cena</td>
                            <td>Ilość</td>
                            <td>Status</td>
                            <td>Zarządzaj</td>
                        </tr>
                        </table>
                        html;
                    }
                ?>
            </div>
        </div>
    </div>

    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/user_info.js"></script>
</body>
</html>