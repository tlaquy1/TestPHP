<?php
session_start();
include_once("model/user.php");
include_once("model/sql.php");
if (!isset($_SESSION["user"]))
    header("location:login.php");
include_once("header.php")
?>
<!-- <?php include_once("nav.php") ?> -->
<?php
//Mã php của trang chủ
$user = unserialize($_SESSION["user"]);
// echo "Xin chào bạn " . $user->fullName;
?>
<?php
$lsFromDB = ThongTin::getListFromDB();
$keyWord = null;
if (isset($_REQUEST["search"])) {
    $keyWord = $_REQUEST["search"];
}
$idTag = null;
if (isset($_REQUEST["maNhan"])) {
    $idTag = $_REQUEST["maNhan"];
}
if ($idTag != null) {
    $lsFromDB = tag::getSearch($idTag);
}
if ($keyWord != null) {
    $lsFromDB = ThongTin::getSearch($keyWord);
}
if (isset($_REQUEST["danhba"])) {
    $lsFromDB = ThongTin::getListFromDB();
}
if (isset($_REQUEST["btnSubmitForm"])) {
    $ten = $_REQUEST["ten"];
    echo $ten;
}

//$lsFromDB=ThongTin::getListFromDB();



?>

  <!-- Navbar content -->

<div class="container-fluid" style=";background-color: antiquewhite">
    
    <div class="row" style="background-color: lightgrey ;    border-width: 3px;
    border-style: groove;
    border-color: aquamarine;">
        <!-- row -->
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <!-- <button type="button" class="btn btn-outline-success" 
            data-toggle="collapse" 
            data-target="#collapseMenu" 
            aria-expanded="true" 
            aria-controls="collapseMenu"
             style=" margin-top: -5px; -webkit-border-radius: 25px; width: 45px;
    height: 45px;"><i class="fas fa-bars"></i>
            </button> -->
            <button type="button" class="btn btn-outline-warning" style=" margin-top: -5px; -webkit-border-radius: 25px; width: 45px;
    height: 45px;"> <i class="fas fa-bars"></i> </button>
            <a> <img src="source/contact2.png" alt="" style="width:40px;">   <span style="font-size: 25px;"> Danh bạ </span></a>
            
        </div>
        <div class="col-lg-7" >

            <form action="" method="GET">
                <!-- <div class="form-group">
                <button type="submit" class="btn btn-default" style="margin-left:-50px" name="submitSearch"><i class="fas fa-search"></i></button>
                    <input class="form-control" value="" name="search" style="max-width: 95%; display:inline-block;" placeholder="Search">
                   
                </div> -->
                <div class="input-group md-form form-sm form-1 pl-0">
                    <div class="input-group-prepend">
                        <button class="input-group-text cyan lighten-2" id="basic-text1" style="background: gray;"><i class="fas fa-search text-white" aria-hidden="true"></i></button>
                    </div>
                    <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" style="    max-width: 90%;    height: 50px;" name="search" value="<?php if ($keyWord != null) echo $keyWord;
                                                                                                                                                                                    else echo "" ?>">
                </div>
            </form>
        </div>
        <div class="col-lg-1"><a href="logout.php" class="btn btn-outline-danger">logout</a></div>
        <!-- end row -->
      
    </div>
    <div class="row">
        <!-- open row -->

        <div class="col-lg-1"></div>
        <div class="col-lg-3" style="background-color:lightgray">
            <!-- col 3 -->
            <!-- <div class="collapse" id="collapseMenu"> -->
            <div style="max-width: 95%;">
                <div>

                    <button class="btn btn-outline-secondary" style="
                                        width: 85%;
                                        height: 44px;
                                        padding: 5px 20px;
                                        border-radius: 20px;
                                        -moz-border-radius: 20px;
                                        -webkit-border-radius: 20px;
                            
                                        background-color: aliceblue;
                                        cursor: pointer;
                                        margin-left: 18px;
                                    
                                        margin-bottom: 8px;" data-toggle="modal" data-target="#addModal">
                        <img src="source/add2.png" alt="">
                        <span>Thêm liên hệ</span>
                    </button>
                </div>

                <div class="list-group">

                    <div>

                        <b> <a href="index.php?danhba=1" class="list-group-item " style="text-decoration: none;color: black;">
                                <span>
                                    Danh bạ
                                    <span class="badge badge-primary badge-pill" style="float: right;"><?php if (count(ThongTin::getListFromDB()) != 0) echo count(ThongTin::getListFromDB());
                                                                                                        else echo ""; ?></span>
                                </span>
                            </a>

                    </div>
                    <div>
                        <a href="#" class="list-group-item " style="text-decoration: none;color: black;"> <span> Thường xuyên liên hệ <span class="badge badge-primary badge-pill" style="float: right;">0</span> </span> </a>
                    </div>
                    <div>
                        <a href="#" class="list-group-item " style="text-decoration: none;color: black;"> <span> Liên hệ trung lập <span class="badge badge-primary badge-pill" style="float: right;">0</span> </span> </a>
                    </div>
                    </b>

                    <hr>
                    <!--  -->
                    <div>
                        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample" style="width: 300px;">
                            <span> Nhãn </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>

                        <div class="collapse" id="collapseExample">
                            <div class="card card-body" style="background-color: bisque;">
                                <!--  -->
                                <?php
                                $listTag = tag::getListTag();
                                foreach ($listTag as $key => $value) {
                                    ?>
                                    <div>
                                        <a href="index.php?maNhan=<?php echo $value->maNhan ?>" class="list-group-item " style="color: black;">
                                            <span>
                                                <i class="fas fa-tag"></i>
                                                <?php echo $value->tenNhan ?>
                                                <span class="badge badge-primary badge-pill" style="float: right;">
                                                    <?php
                                                        echo tag::countContactOfTag($value->maNhan);
                                                        ?>
                                                </span>
                                            </span>
                                        </a>
                                    </div>

                                <?php
                                }
                                ?>
                                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addNhanModal"><i class="fas fa-plus"></i><span> Thêm nhãn mới</span></button>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- </div> -->
            <!-- end col 3 -->
        </div>
        <div class="col-lg-7" style="background-color: antiquewhite">
            <!-- col 7 -->
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($lsFromDB as $key => $value) {

                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                    <?php echo $value->ten ?>
                                </td>
                                <td><?php echo $value->email ?></td>
                                <td><?php echo $value->sdt ?></td>

                                <td>
                                    <a href="add.php?idDelete=<?php echo $value->id ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end col 7 -->
        </div>
        <div class="col-lg-1" ></div>
    </div>
    <!-- end row -->
</div>

<!-- model them -->
<form action="add.php" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm</h5>
                    <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!-- <div class="form-group d-flex">
                                <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                                <div class="col-md-10">
                                    <input id="id" name="id" type="text" placeholder="ID" class="form-control input-md">
                                </div>
                            </div> -->
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                            <div class="col-md-10">
                                <input id="name" name="id" type="text" placeholder="Id" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Name</label>
                            <div class="col-md-10">
                                <input id="name" name="ten" type="text" placeholder="Name" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Phone</label>
                            <div class="col-md-10">
                                <input id="phone" name="sdt" type="text" placeholder="Phone" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Email">Email</label>
                            <div class="col-md-10">
                                <input type="email" id="email" name="email" placeholder="nva@gmail.com" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Email">Nhãn</label>
                            <div class="col-md-10">
                                
                                <select name="chooseNhan" id="chooseNhan">
                                    <?php
                                    $listTag = tag::getListTag();
                                    foreach ($listTag as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value->maNhan?>"> <?php echo $value->tenNhan?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addThongtin" class="btn btn-primary" name="btnSubmitForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--  -->
<!-- model thêm nhãn -->
<form action="add.php" method="post">
    <div class="modal fade" id="addNhanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm</h5>
                    <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>

                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">MaNhan</label>
                            <div class="col-md-10">
                                <input id="maNhan" name="maNhan" type="text" placeholder="Id: nhan1" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">TenNhan</label>
                            <div class="col-md-10">
                                <input id="tenNhan" name="tenNhan" type="text" placeholder="Name" class="form-control input-md">
                            </div>
                        </div>


                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addNhan" class="btn btn-primary" name="btnAddNhan">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--  -->
<?php include_once("footer.php") ?>