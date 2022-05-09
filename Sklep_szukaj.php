<?php
    session_start();

    $connect=new mysqli('localhost', 'root', '', 'sklep');

    $nazwa = $_GET['name'];

    $sql="SELECT * FROM products WHERE Nazwa LIKE '$nazwa%'";
    $result = mysqli_query($connect, $sql);

    if(!mysqli_num_rows($result)>0)
    {
        $error[]= "Brak wyszukań dla: $nazwa";
    }

    $sql1 = "SELECT * FROM categories";
    $result1 =mysqli_query($connect, $sql1);

    if(isset($_POST['submit_search']))
    {
        $nazwa = $_POST['search'];
        if(!empty($nazwa))
        {
            header("Location: Sklep_szukaj.php?name=$nazwa");
        }
    }

    if(isset($_POST['submit_sortowanie_cena']))
    {
        $value = $_POST['sortowanie'];

        if($value=='1')
        {
            $sql="SELECT * FROM products WHERE Nazwa LIKE '$nazwa%' ORDER BY Cena ASC";
            $result = mysqli_query($connect, $sql);
        }
        else if($value=='2')
        {
            $sql="SELECT * FROM products WHERE Nazwa LIKE '$nazwa%' ORDER BY Cena DESC;";
            $result = mysqli_query($connect, $sql);
        }
        else if($value=='3')
        {
            $sql = "SELECT * FROM products WHERE Nazwa LIKE '$nazwa%'";
            $result = mysqli_query($connect, $sql);
        }
    }

    if(isset($_POST['submit_sortowanie_nazwa']))
    {
        $value = $_POST['sortowanie'];

        if($value=='1')
        {
            $sql="SELECT * FROM products WHERE Nazwa LIKE '$nazwa%' ORDER BY Nazwa ASC";
            $result = mysqli_query($connect, $sql);
        }
        else if($value=='2')
        {
            $sql="SELECT * FROM products WHERE Nazwa LIKE '$nazwa%' ORDER BY Nazwa DESC";
            $result = mysqli_query($connect, $sql);
        }
        else if($value=='3')
        {
            $sql = "SELECT * FROM products WHERE Nazwa LIKE '$nazwa%'";
        $result = mysqli_query($connect, $sql);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bigibongo Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="css/sklep_style.css">
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
                <div class="sidenav">
                    <h1>Filtry:</h1>
                    <br>
                    <h3>Szukaj:</h3>
                    <form action="" method="POST">
                        <input type="text" placeholder="czego szukasz?" name="search">
                        <button type="submit" name="submit_search"><i class="fa fa-search"></i></button>
                    </form>
                    <br>
                    <?php
                        if(!empty($nazwa))
                        {
                            echo"<h4>Wyszukiwania dla: ".$nazwa."</h4>";
                        }
                     ?>

                    <br>
                    <hr>
                    <br>
                    <h3>Kategorie:</h3>
                    <a a href='Sklep.php'>Wszystkie</a>
                    <?php
                        for($i=0; $i<mysqli_num_rows($result1); $i++)
                        {
                            $row = mysqli_fetch_assoc($result1);
                            echo"<a href='Sklep_kategoria.php?id=$row[Id_kategorii]'>$row[Nazwa]</a>";
                        }
                    ?>

                    <br>
                    <hr>
                    <br>

                    <h3>Sortuj (Cena):</h3>
                    <form class="form-sort" method="POST" action="">
                        <input class="checkbox" type="checkbox" name="sortowanie" id="1" value="1" onclick="getSelectItemThat(id)">
                        <label>Rosnąca</label><br>

                        <input class="checkbox" type="checkbox" name="sortowanie" id="2" value="2" onclick="getSelectItemThat(id)">
                        <label>Malejąco</label><br>

                        <input class="checkbox" type="checkbox" name="sortowanie" id="3" value="3" onclick="getSelectItemThat(id)">
                        <label>Losowo</label><br>
                        <input type="submit" name="submit_sortowanie_cena" class="menu-btn" value="Zastosuj">
                    </form>
                    <br>
                    <hr>
                    <br>

                    <h3>Sortuj (Nazwa):</h3>
                    <form class="form-sort" method="POST" action="">
                        <input class="checkbox" type="checkbox" name="sortowanie" id="4" value="1" onclick="getSelectItemThat(id)">
                        <label>Od A do Z</label><br>

                        <input class="checkbox" type="checkbox" name="sortowanie" id="5" value="2" onclick="getSelectItemThat(id)">
                        <label>Od Z do A</label><br>

                        <input class="checkbox" type="checkbox" name="sortowanie" id="6" value="3" onclick="getSelectItemThat(id)">
                        <label>Losowo</label><br>
                        <input type="submit" name="submit_sortowanie_nazwa" class="menu-btn" value="Zastosuj">
                    </form>
                </div>


        <div class="Items">
            <?php

                if(isset($error))
                {
                    foreach($error as $error)
                    {
                        echo"<h1>$error</h1>";
                    }
                }
                for($i=0; $i<mysqli_num_rows($result); $i++)
                {
                    $row = mysqli_fetch_assoc($result);
                    echo<<<html
                    <div class="Item">
                    <a href="produkt.php?id=$row[Id_produktu]" class="Item__link">
                        <div class="ImageContainer">
                        <img src="images/aura.png" class="Image">
                        </div>
                        <div class="Item__title">
                            <h2>$row[Nazwa]</h2>
                        </div>
                        <div class="Item__price">$row[Cena]zł</div>
                    </a>
                    <form method='POST' action='Koszyk_modyfikacje.php?mode=dodaj&id_produktu=$row[Id_produktu]'>
                        <button name='submit' class='btn'>Dodaj do koszyka</button>
                    </form> 
                    </div>
                    html;
                }
            ?>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/sklep-script.js"></script>
</body>
</html>