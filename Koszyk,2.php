<?php
    session_start();
    if(!$_SESSION['user']){
        header("Location: Logowanie.php ");
    }


    $cena = $_POST['cena'];
    $id_klienta = $_SESSION['id'];
    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql = "SELECT * FROM carts WHERE Id_klienta = $id_klienta";
    $result = mysqli_query($connect,  $sql);
    if(mysqli_num_rows($result)<1){
        header("Location: Koszyk.php");
    }

    $sql_dostawa ="SELECT * FROM delivery_method";
    $result_dostawa = mysqli_query($connect, $sql_dostawa);

    $sql_platnosc="SELECT * FROM payments";
    $result_platnosc = mysqli_query($connect, $sql_platnosc);

    $sql_adres = "SELECT * FROM accounts_address WHERE Id_klienta = $id_klienta";
    $result_adres = mysqli_query($connect, $sql_adres);
    $row_adres = mysqli_fetch_assoc($result_adres);

    if(mysqli_num_rows($result_adres)<1){
        $row_ulica = '';
        $row_budynek = '';
        $row_pocztowy = '';
        $row_miasto = '';

        $sql_wojewodztwo = "SELECT * FROM provinces";
        $result_woj = mysqli_query($connect, $sql_wojewodztwo);

    }else{
        $row_ulica = $row_adres['Ulica'];
        $row_budynek = $row_adres['Nr_budynku'];
        $row_pocztowy = $row_adres['Kod_pocztowy'];
        $row_miasto = $row_adres['Miasto'];
        $id_wojewodztwa = $row_adres['Id_wojewodztwa'];

        $sql_wojewodztwo = "SELECT * FROM provinces WHERE Id_wojewodztwa = $id_wojewodztwa";
        $result_woje = mysqli_query($connect, $sql_wojewodztwo);
        $row_woj = mysqli_fetch_assoc($result_woje);

        $sql_wojewodztwo_pozostale = "SELECT * FROM provinces WHERE Id_wojewodztwa != $id_wojewodztwa";
        $result_woj_pozostale = mysqli_query($connect, $sql_wojewodztwo_pozostale);
    }

    // if(isset($_POST['submit'])){

    //     $id_dostawy = $_POST['radio_dostawa'];
    //     $id_platnosci = $_POST['radio_platnosc'];
    //     $ulica = $_POST['ulica'];
    //     $nr_budynku = $_POST['nr_budynku'];
    //     $kod_pocztowy = $_POST['kod_pocztowy'];
    //     $miasto = $_POST['miasto'];
    //     $wojewodztwo = $_POST['wojewodztwo'];
    //     $data = date("Y-m-d");

    //     $sql_dostawa_cena = "SELECT * FROM delivery_method WHERE Id_dostawy = $id_dostawy";
    //     $result_dostawa_cena = mysqli_query($connect, $sql_dostawa_cena);
    //     $row_dostawa = mysqli_fetch_assoc($result_dostawa_cena);

    //     $sql_platnosc_cena = "SELECT * FROM payments WHERE Id_platnosci = $id_platnosci";
    //     $result_platnosc_cena = mysqli_query($connect, $sql_platnosc_cena);
    //     $row_platnosc = mysqli_fetch_assoc($result_platnosc_cena);

    //     $cena = $_GET['price'] + $row_dostawa['Cena'] + $row_platnosc['Cena'];

    //     // $sql_insert = "INSERT INTO orderS(Id_klienta, Id_dostawy, Id_platnosci, Data_zamowienia, Cena, Ulica, Nr_budynku, Kod_pocztowy, Miasto, Id_wojewodztwa,Id_statusu) VALUES ('$id_klienta','$id_dostawy','$id_platnosci','$data','$cena','$ulica','$nr_budynku','$kod_pocztowy','$miasto','$wojewodztwo', '0')";
    //     // mysqli_query($connect, $sql_insert);
    //     header("Location: Koszyk,3.php");
    // }
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
         
         <form method="POST" action='Koszyk,3.php'>
            <div class="row">
                <div class="col-sm-6">
                    <h3>Przesyłka:</h3>
                        <?php

                            for($i =0; $i<mysqli_num_rows($result_dostawa); $i++)
                            {
                                $row = mysqli_fetch_assoc($result_dostawa);
                                if($row['Id_dostawy']==1){
                                    echo<<<html
                                        <div class='radio'>
                                            <label>
                                                <input type='radio' name='radio_dostawa' required value='$row[Id_dostawy]' checked>
                                                $row[Nazwa] | $row[Cena],00zł
                                            </label>
                                        </div>
                                    html;
                                }else{

                                echo "
                                <div class='radio'>
                                    <label>
                                        <input type='radio' name='radio_dostawa' required value='$row[Id_dostawy]'>
                                        $row[Nazwa] | $row[Cena],00zł
                                    </label>
                                </div>";
                                }
                            }
                        ?>
                        <br>
                        <h3>Płatność:</h3>
                        <?php
                            for($i=0; $i<mysqli_num_rows($result_platnosc); $i++){
                                $row = mysqli_fetch_assoc($result_platnosc);
                                if($row['Id_platnosci']==1){
                                    echo<<<html
                                        <div class='radio'>
                                            <label>
                                                <input type='radio' name='radio_platnosc' required value='$row[Id_platnosci]' checked>
                                                $row[Nazwa] | $row[Cena],00zł
                                            </label>
                                        </div>
                                    html;
                                }else{

                                    echo "
                                    <div class='radio'>
                                        <label>
                                            <input type='radio' name='radio_platnosc' required value='$row[Id_platnosci]'>
                                            $row[Nazwa] | $row[Cena],00zł
                                        </label>
                                    </div>";
                                    
                                }
                            }
                        ?>
                </div>
                <div class="col-sm-6">
                    <h3>Dane adresowe:</h3>
                    <table> 
                        <tr>
                            <?php
                                echo<<<html
                                    <tr>
                                    <td>
                                        Ulica
                                    </td>
                                    <td>
                                        <input type='text' name='ulica' required value='$row_ulica'>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>Nr. budynku</td>
                                        <td>
                                    
                                            <input type='text' name='nr_budynku' required value='$row_budynek'>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kod pocztowy</td>
                                        <td>
                                    
                                        <input type='text' name='kod_pocztowy' required value='$row_pocztowy'>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Miasto</td>
                                        <td>
                                            <input type='text' name='miasto' required value='$row_miasto'>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Wojewodztwo</td>
                                        <td>
                                        <select name='wojewodztwo' required>
                                html;
                                    if(mysqli_num_rows($result_adres)<1){
                                        for($i=0; $i<mysqli_num_rows($result_woj); $i++){
                                            $row = mysqli_fetch_assoc($result_woj);
                                            echo<<<html
                                            <option value='$row[Id_wojewodztwa]'>$row[Nazwa]</option>
                                            html;
                                        }
                                    }else{
                                        echo<<<html
                                        <option value='$row_woj[Id_wojewodztwa]'>$row_woj[Nazwa]</option>
                                        html;

                                        for($i=0; $i<mysqli_num_rows($result_woj_pozostale); $i++){
                                            $row = mysqli_fetch_assoc($result_woj_pozostale);
                                            echo<<<html
                                            <option value='$row[Id_wojewodztwa]'>$row[Nazwa]</option>
                                            html;
                                        }
                                    }
                                echo<<<html
                                        </select>
                                    </td>
                                </tr>
                                <input type='hidden' name='cena' value='$cena'>
                                html;
                            ?>
                    </table>
                    <button class="btn_next">Dalej</button>
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