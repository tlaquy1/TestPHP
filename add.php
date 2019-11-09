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
    $nhan=$_REQUEST["chooseNhan"];
    //echo $ten." ".$sdt." ".$email." ".$nhan;
    ThongTin::addToDB($id,$ten,$email,$sdt);
    tag::addTagContact($id,$nhan);
    }
    if(isset($_REQUEST["maNhan"])){
        $maNhan=$_REQUEST["maNhan"];
        $tenNhan=$_REQUEST["tenNhan"];
       
        //echo $ten." ".$sdt." ".$email;
        tag::addNhanToDB($maNhan,$tenNhan);
        }
    header("location:index.php");
?>