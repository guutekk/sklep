<?php

    session_start();

    if (!isset($_SESSION['user']) || !$_SESSION['type']==1) {
		header('Location: ../index.php');
	}

    $connect=new mysqli('localhost', 'root', '', 'sklep');

    if(isset($_POST['submit_usun']))
    {
        $id_produktu = $_POST['id_produktu'];
        $id_zdjecia = $_POST['id_zdjecia'];
        $sql = "DELETE FROM `images` WHERE Id_zdjecia = $id_zdjecia";
        mysqli_query($connect, $sql);
        header("Location: Zdjecia.php?id=$id_produktu");
    }

    if(isset($_POST['submit_dodaj'])){
        $id_produktu = $_POST['id_produktu'];

        $targetDir = "../images/"; 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		$insertValuesSQL = "";

		$fileNames = array_filter($_FILES['files']['name']); 
		if(!empty($fileNames)){ 
			foreach($_FILES['files']['name'] as $key=>$val){ 
				// File upload path 
				$fileName = basename($_FILES['files']['name'][$key]); 
				$targetFilePath = $targetDir . $fileName; 

				// Check whether file type is valid 
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
				if(in_array($fileType, $allowTypes)){ 
					// Upload file to server 
					if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
						// Image db insert sql 
						$insertValuesSQL .= "('".$fileName."', NOW(), '".$id_produktu."'),";
					}
				}
			} 

			if(!empty($insertValuesSQL)){ 
				$insertValuesSQL = trim($insertValuesSQL, ','); 
				// Insert image file name into database 
            	$insert ="INSERT INTO images (Nazwa_pliku, uploaded_on, Id_produktu) VALUES $insertValuesSQL";
                mysqli_query($connect, $insert); 
			}
		} 
        header("Location: Zdjecia.php?id=$id_produktu");
    }

    if(isset($_POST['submit_edytuj'])){
        $id_produktu = $_POST['id_produktu'];
        $id_zdjecia = $_POST['id_zdjecia'];

        $targetDir = "../images/"; 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		$insertValuesSQL = "";

		$fileNames = array_filter($_FILES['files']['name']); 
		if(!empty($fileNames)){ 
			foreach($_FILES['files']['name'] as $key=>$val){ 
				// File upload path 
				$fileName = basename($_FILES['files']['name'][$key]); 
				$targetFilePath = $targetDir . $fileName; 

				// Check whether file type is valid 
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
				if(in_array($fileType, $allowTypes)){ 
					// Upload file to server 
					if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
						// Image db insert sql 
						$insertValuesSQL .= "('".$fileName."', NOW(), '".$id_produktu."'),";
					}
				}
			} 

			if(!empty($insertValuesSQL)){ 
                $insert ="UPDATE images SET Nazwa_pliku='$fileName', uploaded_on=NOW() WHERE Id_produktu = $id_produktu AND Id_zdjecia = $id_zdjecia";
                echo $insert;
                mysqli_query($connect, $insert);  
			}
		} 
        header("Location: Zdjecia.php?id=$id_produktu");
	}
?>