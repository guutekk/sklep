<?php
    session_start();
    $connect=new mysqli('localhost', 'root', '', 'sklep');
    $id_produktu =$_GET['id_produktu'];
    $ilosc_get = $_GET['ilosc'];
    if(!isset($_SESSION['id'])){
        header("Location: Logowanie.php");
    }
    $id_klienta = $_SESSION['id'];
    
    $sql1 = "SELECT * FROM carts WHERE Id_produktu = $id_produktu AND Id_klienta = $id_klienta";
    $result = mysqli_query($connect, $sql1);
    $row = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM products WHERE Id_produktu = $id_produktu";
    $result1 = mysqli_query($connect, $sql2);
    $row1 = mysqli_fetch_assoc($result1);
    
    $ilosc_baza = $row1['Ilosc'];

    $ilosc = $row['Ilosc']+$ilosc_get;

    if($_GET['mode']=='dodaj')
    {
        if(mysqli_num_rows($result)>0)
        {
            if($ilosc<=$ilosc_baza)
            {
                $sql = "UPDATE carts SET Ilosc='$ilosc' WHERE Id_produktu=$id_produktu AND Id_klienta = $id_klienta AND 'Status' = 0";
                mysqli_query($connect, $sql);
            }else if($ilosc>$ilosc_baza)
            {
                $sql = "UPDATE carts SET Ilosc='$ilosc_baza' WHERE Id_produktu=$id_produktu AND Id_klienta = $id_klienta AND 'Status' = 0";
                mysqli_query($connect, $sql);
            }
        }else
        {
            if($ilosc_get>1)
            {
                $sql = "INSERT INTO carts(Id_produktu, Ilosc, Id_klienta, 'Status') VALUES ('$id_produktu','$ilosc_get','$id_klienta','0')";
                mysqli_query($connect, $sql);
            }else{
                $sql = "INSERT INTO carts(Id_produktu, Ilosc, Id_klienta, 'Status') VALUES ('$id_produktu','1','$id_klienta','0')";
                mysqli_query($connect, $sql);
            }
        }
        header("Location: Koszyk.php");
    }
?>