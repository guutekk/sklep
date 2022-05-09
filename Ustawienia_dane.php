<?php
session_start(); 
$connect=new mysqli('localhost', 'root', '', 'sklep');

if(!isset($_SESSION['user']) && !isset($_SESSION['nazwisko']) && !isset($_SESSION['email']) && !isset($_SESSION['haslo'])) {
    header('Location: index.php');
}
    if(isset($_POST['submit'])){

            $name = $_POST['imie'];
            $lastname = $_POST['nazwisko'];
            $tel = $_POST['telefon'];
            $email = $_SESSION['email'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];

        if($pass=="" && $cpass=="")
        {
            $query ="UPDATE accounts SET Imie='$name', Nazwisko='$lastname', Telefon='$tel', Haslo='{$_SESSION['haslo']}' WHERE Email='$email'";
            $connect->query($query);
            $sql = "SELECT * FROM accounts WHERE Email='$email'";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['Email'] == $email)
                    {
                        $_SESSION['user'] = $row['Imie'];
                        $_SESSION['nazwisko'] = $row['Nazwisko'];
                        $_SESSION['telefon'] = $row['Telefon'];
                        $_SESSION['email'] = $row['Email'];
                        $_SESSION['haslo'] = $row['Haslo'];
                        header('Location: Ustawienia.php');
                    }
                }
        }else{
            if($pass!=$cpass){
                $error[]='Hasła się nie zgadzają!';
            }else{
                $pass = md5($pass);
                if($pass != $_SESSION['haslo'])
                {
                    $query ="UPDATE accounts SET Imie='$name', Nazwisko='$lastname', Telefon='$tel',  Haslo='$pass' WHERE Email='$email'";
                    $connect->query($query);
    
                    $sql = "SELECT * FROM accounts WHERE Email='$email'";
                    $result = mysqli_query($connect, $sql);
    
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['Email'] == $email){
                            $_SESSION['user'] = $row['Imie'];
                            $_SESSION['nazwisko'] = $row['Nazwisko'];
                            $_SESSION['email'] = $row['Email'];
                            $_SESSION['haslo'] = $row['Haslo'];
                            header('Location: Ustawienia.php');
                        }
                    }
                }else{
                    $error[]="Nie możesz ustawić takiego samego hasła jak aktualne!";
                }
            }
        }
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
						if(!isset($_SESSION['user']))
						{
							echo<<<html
								<li><a href="Logowanie.php"><ion-icon name="log-in"></ion-icon> ZALOGUJ SIĘ</a></li>
							html;
						}else{
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
		</div>
    <section>
        <div class="settings-container">
            <h1>Moje dane</h1><br>
            <?php 
                    if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error">'.$error.'</span>';
                    };
                };
            ?>
            <table>
                <tbody>
                    <tr>
                        <td>Imię</td>
                        <td>
                            <form method="POST">
                            <input type="text" name = "imie" minlength="3" value= "<?php echo $_SESSION['user'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Nazwisko</td>
                        <td>
                            <input type="text" name = "nazwisko" minlength="3" value= "<?php echo $_SESSION['nazwisko'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Telefon</td>
                        <td>
                            <input type="text" name = "telefon" minlength="9" maxlength="9" value= "<?php echo $_SESSION['telefon'];?>">
                        </td>
                    </td>
                    <tr>
                        <td>Nowe haslo</td>
                        <td>
                            <input type="password" name = "pass" minlength="6" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Powtórz nowe haslo</td>
                        <td>
                            <input type="password" name = "cpass" minlength="6" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button name="submit" class="btn">Zapisz zmiany</button><br>
                            </form>
                            <a href="Ustawienia.php" class="btn">Powrót</a>
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