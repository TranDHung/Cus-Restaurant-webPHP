<?php
  session_start();
  require_once('AccountDB.php');
  require('RoomDB.php');
  require('MenuDB.php');
  require('TheOrderDB.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css" href = "style.css">
      body {
      font-family: Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background: #F2F2F2;
    }
    .navbar-expand-sm{
      background-color: #58ACFA;
    }
    .edit-bill-form{
      margin: auto;
      padding-top: 20px;
      padding-bottom: 50px;
      text-align: center;
      width: 640px;
      background-color: white;
      overflow: auto;
      margin-top: 30px;
      margin-bottom: 30px;
      border-radius: 5px;
    }
    .food{
      display: table-row;
      width: 600px;
      height: 100px;
      padding: 20px;
    }
    .room{
      display: inline-flex;
      margin-right: 300px;
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .total{
      display: inline-flex;
      margin-top: 20px;
    }
    .field{
        padding-bottom: 30px;
        padding-right: 10px;
        margin-bottom: 20px;
      }
      .field span{
        float: left;
        padding-top: 17px;
        margin-top: -10px;
        margin-left: 50px;
      }
    .form-control{
        border: none;
        margin-right: 50px;
        margin-bottom: 10px;
        float: right;
        width: 250px;
      }
      .form-control:focus {
      box-shadow: 1px;
      border-color: #01A9DB;
    }
    .text-create{
      font-size: 30px;
      font-weight: bold;
      background: #2E64FE;
      margin-left: -20px;
      margin-top: -20px;
      padding: 10px;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      color: white;
    }
  </style>

  <?php
    $hoadon = new QuanLy();
    $result = $hoadon->getThongTinHoaDonById($_SESSION['idBill']);
    $tenNV = $result['nguoilap'];
    $tenKhach = $result['tenkhach'];
    $ngayLap = $result['ngaylap'];
    $monAn = $result['monan'];
    $phong = $result['phong'];
    $thanhTien = $result['thanhtien'];
  ?>
  </head>

<body>
  <nav class="navbar navbar-expand-sm navbar-infor">
    <a href="indexManager.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="195px" height="45px"></a>
    <a class="navbar-brand" href="indexManager.php"><h3 style="color:white; margin-top: 1px"></h3></a>

      <ul class="navbar-nav" style="padding-left: 710px; font-size: 20px">
   
                    <li class="nav-item">
                    <a href="IndexManager.php" class="navbar-brand"><i class = "management"><img src="Image/management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Quản Lý</div></a>
                  </li>
          <li class="nav-item">
            <a class="nav-link" href="EditProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>
    <div class="edit-bill-form">
  <div class="field" style="margin-top: 10px;">
    <span>Tên nhân viên lập: </span>
    <p class="form-control"><?= $tenNV?></p>
  </div>
  <div class="field">
    <span>Ngày lập: </span>
    <p class="form-control"><?= $ngayLap?></p>
  </div>
  <div class="field">
    <span>Tên khách: </span>
    <p class="form-control"><?= $tenKhach?></p>
  </div>

  <div class="ordered-food-list">
    <?php
    $danhSach = explode(',',$monAn);
    $danhSachMonAn = [];
    $danhSachSoLuong = [];
    foreach ($danhSach as $mon) {
      $monVaSoLuong = explode(':',$mon);
      if(!empty($monVaSoLuong[1])){
        array_push($danhSachMonAn, $monVaSoLuong[0]);
        array_push($danhSachSoLuong, $monVaSoLuong[1]);
      }
    }
    for($i = 0; $i<count($danhSachMonAn); $i++) {
        $soLuong = $danhSachSoLuong[$i];
        $mon = new MonAn();
        $result = $mon->getThongTinMonAnById($danhSachMonAn[$i]);
        $tong = $soLuong*$result['gia'];
    ?>
      <div class="food">
      <div class="food-name" style="margin-top: 30px; margin-right: -150px; margin-bottom: -45px;">
        <?= $result['ten']?>
      </div>
      <div class="food-price" style=" margin-right: -550px; margin-top: 23px; margin-bottom: -25px;"><?=$mon->productPrice($result['gia'])?> đ</div>
      <div>
        <p style="width: 50px; height: 25px; position: absolute; left: 750px;  text-align: center;" name="soluong"><?= $soLuong?></p>
      <div class="sum-price" style="margin-left: 50px;position: absolute; left: 780px;"><?= $mon->productPrice($tong)?> đ</div>
      </div>
    </div>
    <?php
  }
?>
  <hr>
  <?php
      $room = new Phong();
      if($phong != ''){
        $result = $room->getthongTinPhongById($phong);
        if($result['kieuphong'] == 1){
              $ten = 'PHÒNG VIP';
            }else{
              $ten = 'PHÒNG THƯỜNG';
         }
    ?>
  <div class="room">
    <div class="room-name" style="margin-right: 120px;">
      <?= $ten?>
    </div>
    <div class="room-price" style="position: absolute; left: 830px;"><?= $room->productPrice($result['gia'])?> đ</div>
  </div>
  <?php
}
?>
  <br>
  <hr>
  <div class="total" style="margin-right: 430px;">
    Tổng tiền: <div class="total-price" style="position: absolute; left: 830px;"><?= $mon->productPrice($thanhTien)?> đ</div>
  </div>
  <hr>
  <a href="indexMaBill.php"><button style="position: absolute; left: 860px; background-color: #6E6E6E; color: white; border: none; width: 100px; height: 30px;border-radius: 3px 3px 3px 3px;">Quay lại</button></a>
</div>
</body>
</html>