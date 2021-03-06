<?php

    session_start();
    $connect=new mysqli('localhost', 'root', '', 'sklep');
    
	$sql = "SELECT * FROM products WHERE Id_produktu = $_GET[id]";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $ilosc = $row['Ilosc'];
    $kategoria = $row['Id_kategorii'];

    $sql1 = "SELECT * FROM products WHERE Id_kategorii = $kategoria AND Id_produktu!=$_GET[id] ORDER BY RAND() LIMIT 3;";
    $result1 = mysqli_query($connect, $sql1);

    if(isset($_POST['submit']))
    {
        $ilosc = $_POST['ilosc'];
        header("Location: Koszyk_modyfikacje.php?mode=dodaj&id_produktu=$row[Id_produktu]&ilosc=$ilosc");
    }

    $sql_zdjecia ="SELECT * FROM images WHERE Id_produktu = $_GET[id]";
    $result_zdjecie = mysqli_query($connect, $sql_zdjecia);

    $sql_zdjecia_1 ="SELECT * FROM images WHERE Id_produktu = $_GET[id]";
    $result_zdjecie_1 = mysqli_query($connect, $sql_zdjecia_1);


    $id=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo"$row[Nazwa]"?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>  
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pr_style.css">
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
                        <li><a href="index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
                        <li><a href="Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
					    <li><a href="Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
					    <li><a href="Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>
    
                        <!--wyswietlanie odpowiednich list z menu do odpowiedniego typu konta (0-user | 1-admin)-->
                        <?php
    
                            //sprawdzanie czy uzytkownik jest zalogowany
                            if(!isset($_SESSION['user']))
                            {
                                echo<<<html
                                    <li><a href="Logowanie.php"><ion-icon name="log-in"></ion-icon> ZALOGUJ SI??</a></li>
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
                                            <li><a href="Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAM??WIENIA</a></li>
                                            <li><a href="Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
                                            <li><a href="wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SI??</a></li>
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


    <div class = "card-wrapper">
        <div class = "card">
            <div class = "product-imgs">
                <div class = "img-display">
                    <div class = "img-showcase">
                        <?php
                            for($i=0; $i<mysqli_num_rows($result_zdjecie); $i++)
                            {
                                $row_zdjecie = mysqli_fetch_assoc($result_zdjecie);
                                $imageURL = 'images/'.$row_zdjecie["Nazwa_pliku"];
                                echo<<<html
                                    <img src = "$imageURL">
                                html;
                            }
                        ?>
                    </div>
                </div>

                <div class = "img-select">
                    <?php
                        for($i=0; $i<mysqli_num_rows($result_zdjecie_1); $i++)
                        {
                            $id+=1;
                            $row_poboczne = mysqli_fetch_assoc($result_zdjecie_1);
                            $imageURL = 'images/'.$row_poboczne["Nazwa_pliku"];
                            echo<<<html
                            <div class = "img-item">
                                <a data-id = "$id">
                                <img src = "$imageURL">
                                </a>
                            </div>
                            html;
                        }
                    ?>
                </div>
                </div>

                <!-- card right -->
                <div class = "product-content">
                <h2 class = "product-title">
                    <?php echo"$row[Nazwa]"?>
                </h2>
                <div class = "product-price">
                    <h2 class = "new-price">Cena: 
                        <span>
                            <?php echo"$row[Cena]"?>z??
                        </span>
                    </h2>
                </div>

                <div class = "product-detail">
                    <h1>Opis: </h1>
                    <p><?php echo"$row[Opis]"?></p>
                </div>

                <div class = "purchase-info">
                    <?php
                        echo<<<html
                            <form method='POST'>
                                <input type = "number" name='ilosc' min = "1" max = "$ilosc" value='1'>
                                <button name='submit' class='btn'>Dodaj do koszyka</button>
                            </form>    
                        html;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <hr class="hr">
    <h3>Podobne produkty</h3>
    <div class="grid-container">
        <?php
			for($i=0; $i<mysqli_num_rows($result1); $i++)
            {
                $row = mysqli_fetch_assoc($result1);
                $sql_zdjecie = "SELECT * FROM images WHERE Id_produktu = $row[Id_produktu] LIMIT 1";
                $result_zdjecie = mysqli_query($connect, $sql_zdjecie);
                echo<<<html
                        <div class="grid-item">
                        <div class="content">
                        <div class="image">
                        html;
                        $row_zdjecie = mysqli_fetch_assoc($result_zdjecie);
                        $imageURL = 'images/'.$row_zdjecie["Nazwa_pliku"];
                        echo<<<html
                            <img src ="$imageURL">

                            <h6>$row[Nazwa]</h6>
                            <a href="produkt.php?id=$row[Id_produktu]" class="btn">Zobacz</a>
                        </div>
                    </div>
                </div>
                html;
            }
        ?>
  </div>
</div>
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
    <script src="js/pr_script.js"></script>
</body>
</html>