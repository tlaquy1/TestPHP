<?php 

      function connect(){
        // $con = new  mysqli("localhost","root","","KtraPHP");
        // $con->set_charset("utf8");//hướng đối tượng
        // if($con->connect_error)
        //     die("kết nối thất bại. Chi tiết:".$con->connect_error);
        // return $con;
        $link = new mysqli('localhost','root','','checkcontact') or die ('Kết nối thất bại');
        mysqli_query($link,'SET NAMES UTF8');
        return $link;
     }

    class ThongTin {
        var $id;
        var $ten;
        var $email;
        var $sdt;
   
        function __construct($id, $ten ,$email, $sdt)
        {
            $this->id = $id;
            $this->ten = $ten;
            $this->email = $email;
            $this->sdt = $sdt;
        }
      
        static function getListFromDB(){
            //b1 tạo kết nối
            // $con = new  mysqli("localhost","root","","BookManager");
            // $con->set_charset("utf8");//hướng đối tượng
            // //mysqli_set_charset($con,"utf8");// thủ tục
            // if($con->connect_error){
            //     die("kết nối thất bại. Chi tiết:".$con->connect_error);
            // }
            $link = connect();
            //b2: thao tác với csdl : CRUD
            $sql = "SELECT * FROM Contact";
            
            $result =  $link->query($sql);
            $list = array();
            
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                    $thongtin = new ThongTin($row["ID"],$row["Ten"],$row["Email"],$row["SDT"]);
                    array_push($list,$thongtin);
                }
            }
            //b3 : đóng kết nối
            $link->close();
            //echo "<h4>kết nối thành công<h4>";
            return $list;
        }
        // /////////////////////////////////////////////////////////////////////////////////////////
        static function addToDB($id=null,$ten=null,$email=null,$sdt=null)
        {
            $link = connect();
           // $sql="INSERT INTO `thongtin`( `Name`, `Phone`, `Email`) VALUES ('$content[0]','$content[1]','$content[2]')";
            $sql="INSERT INTO `contact` (`ID`, `Ten`, `Email`, `SDT`) VALUES ($id, '$ten', '$email', '$sdt')";
        // $result =  $con->query($sql);
            //mysqli_query($link, $sql);
            if (mysqli_query($link, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
            //b3 : đóng kết nối
            $link->close();
        }
        // static function editDB($content){
        //     $con = ThongTin::connect();
        //     $sql="UPDATE `thongtin` SET `Name`='$content[1]',`Phone`='$content[2]',`Email`='$content[3]' WHERE ID='$content[0]'";
        //     if (mysqli_query($con, $sql)) {
        //         echo "New record created successfully";
        //     } else {
        //         echo "Error: " . $sql . "<br>" . mysqli_error($con);
        //     }
        //     $con->close();
        // }
        static function deleteDB($id){
            $link = connect();
            //$sql="DELETE FROM `thongtin` WHERE ID = '$id'";
            $sql="DELETE FROM `contact` WHERE `contact`.`ID` = $id";
            if (mysqli_query($link, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
            //b3 : đóng kết nối
            $link->close();
        }
        static function getSearch($search = null){
            $link = connect();
            
            //$sql="SELECT * FROM Contact where ID = '%$search%' or Name like N'%$search%' or Phone like '%$search%' or Email like '%$search%' ";
            $sql="SELECT * FROM `contact` WHERE `ID`='$search' or `Ten` LIKE N'%$search%' or `Email` LIKE N'%$search%' or `SDT` LIKE N'%$search%'";
            $result =  $link->query($sql);
            $list = array();
            
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                    $thongtin = new ThongTin($row["ID"],$row["Ten"],$row["Email"],$row["SDT"]);
                    array_push($list,$thongtin);
                }
            }
            $link->close();
            return $list;
        }
        // 
        // 
        // 
       

        // 
    }
    class tag {
        var $maNhan;
        var $tenNhan;
     
        function __construct($maNhan, $tenNhan )
        {
            $this->maNhan = $maNhan;
            $this->tenNhan = $tenNhan;
         
        }
       
        static function getListTag(){
            //b1 tạo kết nối
            // $con = new  mysqli("localhost","root","","BookManager");
            // $con->set_charset("utf8");//hướng đối tượng
            // //mysqli_set_charset($con,"utf8");// thủ tục
            // if($con->connect_error){
            //     die("kết nối thất bại. Chi tiết:".$con->connect_error);
            // }
            $link = connect();
            //b2: thao tác với csdl : CRUD
            $sql = "SELECT * FROM nhan";
            
            $result =  $link->query($sql);
            $list = array();
            
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                    $tag = new tag($row["MaNhan"],$row["TenNhan"]);
                    array_push($list,$tag);
                }
            }
            //b3 : đóng kết nối
            $link->close();
            //echo "<h4>kết nối thành công<h4>";
            return $list;
        }
        static function getSearch($idTag = null){
            $link = connect();
            
            
            //$sql="SELECT * FROM `contact` WHERE `ID`='$search' or `Ten` LIKE N'%$search%' or `Email` LIKE N'%$search%' or `SDT` LIKE N'%$search%'";
                $sql="SELECT DISTINCT contact.ID AS ID, contact.Ten AS Ten,contact.Email AS Email,contact.SDT AS SDT
                FROM contact,tag,nhan 
                WHERE nhan.MaNhan=tag.MaNhan 
                AND tag.ID= contact.ID AND tag.MaNhan='$idTag'";
            $result =  $link->query($sql);
            $list = array();
            
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                    $thongtin = new ThongTin($row["ID"],$row["Ten"],$row["Email"],$row["SDT"]);
                    array_push($list,$thongtin);
                }
            }
            $link->close();
            return $list;
        }
        static function countContactOfTag($idTag=null){
            $link=connect();
            $sql="SELECT COUNT(tag.ID) AS DEM FROM `tag` WHERE `MaNhan`='$idTag'";
            $result =  $link->query($sql);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                    $count = $row["DEM"];
                   
                }
            }
            $link->close();
            return $count;
        }
        //INSERT INTO `nhan` (`MaNhan`, `TenNhan`) VALUES ('nhan4', 'FPT');
        static function addNhanToDB($maNhan=null,$tenNhan=null)
        {
            $link = connect();
           // $sql="INSERT INTO `thongtin`( `Name`, `Phone`, `Email`) VALUES ('$content[0]','$content[1]','$content[2]')";
            $sql="INSERT INTO `nhan` (`MaNhan`, `TenNhan`) VALUES ('$maNhan', '$tenNhan')";
        // $result =  $con->query($sql);
            //mysqli_query($link, $sql);
            if (mysqli_query($link, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
            //b3 : đóng kết nối
            $link->close();
        }
        //INSERT INTO `tag` (`ID`, `MaNhan`) VALUES ('5', 'nhan3');
        static function addTagContact($id=null,$maNhan=null)
        {
            $link = connect();
            $sql="INSERT INTO `tag` (`ID`, `MaNhan`) VALUES ('$id', '$maNhan')";
                if (mysqli_query($link, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
    
            $link->close();
        }
    }
?>