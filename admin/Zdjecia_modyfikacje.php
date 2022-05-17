<?php

    session_start();

    if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

    $connect=new mysqli('localhost', 'root', '', 'sklep');

    if(isset($_POST['submit_usun_poboczne']))
    {
        $id_produktu = $_POST['id_produktu'];
        $id_zdjecia = $_POST['id_zdjecia'];
        $sql = "DELETE FROM `images` WHERE Id_zdjecia = $id_zdjecia";
        mysqli_query($connect, $sql);
        header("Location: Zdjecia.php?id=$id_produktu");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>