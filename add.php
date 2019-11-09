<?php 
    include_once("model/sql.php");
    if(isset($_REQUEST["idDelete"])){
        $idDelete=$_REQUEST["idDelete"];
        ThongTin::deleteDB($idDelete    );
    }
    
    if(isset($_REQUEST["id"])){
    $id=$_REQUEST["id"];
    $ten=$_REQUEST["ten"];
    $sdt=$_REQUEST["sdt"];
    $email=$_REQUEST["email"];
    echo $ten." ".$sdt." ".$email;
    ThongTin::addToDB($id,$ten,$email,$sdt);
    }
    header("location:index.php");
?>