<?php
    session_start();

	if (!isset($_SESSION['user'])){
		header('Location: ../index.php');
	}

	$connect=new mysqli('localhost', 'root', '', 'sklep');

    $sql = "SELECT * FROM provinces";
    $result = mysqli_query($connect, $sql);

	if(isset($_POST['submit'])){
        $id_klienta =$_SESSION['id'];
		$ulica = $_POST['ulica'];
		$nr_budynku = $_POST['nr_budynku'];
		$kod_pocztowy = $_POST['kod_pocztowy'];
		$miasto = $_POST['miasto'];
        $wojewodztwo = $_POST['wojewodztwo'];

		$sql="INSERT INTO `accounts_address`(`Id_klienta`, `Ulica`, `Nr_budynku`, `Kod_pocztowy`, `Miasto`, `Id_wojewodztwa`) 
        VALUES ('$id_klienta','$ulica','$nr_budynku','$kod_pocztowy','$miasto','$wojewodztwo')";
		mysqli_query($connect, $sql);
		header('Location: Ustawienia_adres.php');
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
	<link rel="stylesheet" href="css/ustawienia_style.css">

</head>
<body>
    <div class="navbar">
        <div>
            <a href="index.php" class="logo"><ion-icon name="bag"></ion-icon>Bigibongo Shop</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php"><ion-icon name="home"></ion-icon> HOME</a></li>
                <li><a href="Sklep.php"><ion-icon name="card"></ion-icon> SKLEP</a></li>
                <li><a href="Kontakt.php"><ion-icon name="help-circle"></ion-icon> KONTAKT</a></li>
                <li><a href="Koszyk.php"><ion-icon name="cart"></ion-icon> KOSZYK</a></li>

                <?php
                    if(isset($_SESSION['user']))
                    {
                        echo<<<html
                            <li><a href="admin/Panel.php"><ion-icon name="lock-open"></ion-icon> PANEL</a></li>
                        html;
                    }
                ?>
                <li><a><ion-icon name="person"></ion-icon> KONTO</a>
                    <ul>
                        <li><a href="Zamowienia.php"><ion-icon name="cart-outline"></ion-icon> ZAMÓWIENIA</a></li>
                        <li><a href="Ustawienia.php"><ion-icon name="settings-outline"></ion-icon> USTAWIENIA</a></li>
                        <li><a href="wyloguj.php"><ion-icon name="log-out-outline"></ion-icon> WYLOGUJ SIĘ</a></li>
                    </ul>
                </li>	
            </ul>
        </nav>
    </div>
        
    <section>
        <div class="settings-container">
                    <h1>Dane adresowe</h1><br>
                    <table>
                        <tbody>
                            <tr>
                                <td>Ulica</td>
                                <td>
                                    <form method="POST">
                                    <input type="text" name = "ulica" minlength="3" require placeholder="Ulica">
                                </td>
                            </tr>
                            <tr>
                                <td>Nr. budynku</td>
                                <td>
                                    <input type="text" name = "nr_budynku" minlength="3" require placeholder="Nr. budynku">
                                </td>
                            </tr>
                            <tr>
                                <td>Kod pocztowy</td>
                                <td>
                                    <input type="text" name = "kod_pocztowy" minlength="5" maxlength="5" require placeholder="Kod pocztowy">
                                </td>
                            </td>
                            <tr>
                                <td>Miasto</td>
                                <td>
                                    <input type="text" name = "miasto"  require placeholder="Miasto">
                                </td>
                            </tr>
                            <tr>
                                <td>Wojewodztwo</td>
                                <td>
                                    <select name="wojewodztwo">
                                        <?php
                                            for($i=0; $i<mysqli_num_rows($result); $i++)
                                            {
                                                $row = mysqli_fetch_assoc($result);
                                                echo "<option value='$row[Id_wojewodztwa]'>$row[Nazwa]</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button name="submit" class="btn">Dodaj adres</button><br>
                                    </form>
                                    <a href="Ustawienia_adres.php" class="btn">Powrót</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
	<script src="js/script.js"></script>
</body>
</html>