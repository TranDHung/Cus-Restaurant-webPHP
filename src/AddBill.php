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
      border-radius: 15px;
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
        border-radius: 5px;
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
    $tenNV = $_SESSION['fullName'];
    $ngayLap = date("d/m/Y");
    $thanhTien = 0;
    $monClass = new MonAn();
    $error1 = '';
    $infor = '';
    $object = [];
    if(isset($_SESSION['iddondat']) && $_SESSION['iddondat'] != ''){
      $donDat = new DonDat();
      $result = $donDat->getthongTinDonDatById($_SESSION['iddondat']);
      $tenKhach = $result['tenkhach'];
      $tongTien = $result['tongtien'];
      $phong = $result['phong'];
      $monAn = $result['monan'];
    }else{
      $tenNV = $_SESSION['fullName'];
      $tenKhach = '';
      $ngayLap = date("d/m/Y");
      if(isset($_SESSION['chonPhong'])){
        $phong = $_SESSION['chonPhong'];
        //echo $phong;
      }else{
        $phong = '';
      }
      $monAn = '';
      if(isset($_SESSION['monAn']) && !empty($_SESSION['monAn'])){
        $tenKhach = $_SESSION['tenkhach'];
        if(!empty($_SESSION['monAn'])){
          foreach ($_SESSION['monAn'] as $key => $value) {
            $string = $key.':'.$value;
            $monAn .= $string.',';
          }
        }
      }
    }
    
    
    if(isset($_POST['nvlap']) && isset($_POST['tenkhach']) && isset($_POST['ngaylap']) && isset($_POST['tao'])){
        $thanhTien = $_POST['tao'];
        $tenKhach = $_POST['tenkhach'];
        if (empty($tenKhach)) {
          $error1 = 'Nhập tên khách hàng';
          $thanhTien = 0;
        }else if($monAn == ''){
          $error1 = 'Chọn món ăn cho hóa đơn';
          $thanhTien = 0;
        }
        else {
          $object['tenNV'] = $tenNV;
          $object['tenKhach'] = $tenKhach;
          $object['ngayLap'] = date("d/m/Y");
          $object['phong'] = $phong;
          $object['monAn'] = $monAn;
          if(isset($_SESSION['iddondat'])){
            $object['thanhTien'] = $tongTien;
          }else{
            $object['thanhTien'] = $thanhTien;
          }
          $quanly = new QuanLy();
          $result = $quanly->lapHoaDon($object);
         if ($result['code'] == 0){
            if(isset($_SESSION['iddondat']) && $_SESSION['iddondat'] != ''){
              $donĐat = new DonDat();
              $trangThai = 1;
              $donĐat->updateTrangThai($_SESSION['iddondat'],$trangThai);
            }
            unset($_SESSION['monAn']);
            unset($_SESSION['chonPhong']);
            unset($_SESSION['tenkhach']);
            unset($_SESSION['createBill']);
            if(isset($_SESSION['iddondat'])){
              unset($_SESSION['iddondat']);
              header("Location: IndexMaPay.php");
            }else{
              header("Location: IndexMaBill.php");
            }
         }else{
            $error1 = 'Thao tác thất bại. Thử lại sau!';
         }
        }
    }
    if(isset($_POST['chonMon'])){
      $_SESSION['createBill'] = true;
      $_SESSION['monAn'] = $_POST['chonMon'];
      $_SESSION['tenkhach'] = $_POST['tenkhach'];
      header("Location: AddDishInOrder.php");
    }
    if(isset($_POST['chonPhong'])){
      $_SESSION['createBill'] = true;
      $_SESSION['chonPhong'] = $_POST['chonPhong'];
      header("Location: ChooseRoom.php");
    }
    if(isset($_POST['delete'])){
      unset($_SESSION['monAn'][$_POST['delete']]);
    }
    if(isset($_POST['deleteRoom'])){
      unset($_SESSION['chonPhong']);
    }
    if(isset($_POST['huy'])){
      unset($_SESSION['monAn']);
      unset($_SESSION['chonPhong']);
      unset($_SESSION['tenkhach']);
      unset($_SESSION['createBill']);
      if(isset($_SESSION['iddondat'])){
        unset($_SESSION['iddondat']);
        header("Location: IndexMaPay.php");
      }else{
        header("Location: IndexMaBill.php");
      }
    }
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
            <a class="nav-link" href="editProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>
    <form class="form-create" method="post" id="thongtin">
    <div class="edit-bill-form">
  <div class="text-create">Thêm hóa đơn</div>
  <div class="field" style="margin-top: 10px;">
    <span>Tên nhân viên lập: </span>
    <input class="form-control" type="text" name="nvlap" value="<?= $tenNV?>" readonly>
  </div>
  <div class="field">
    <span>Ngày lập: </span>
    <input class="form-control" type="text" name="ngaylap" value="<?= $ngayLap?>" readonly>
  </div>
  <div class="field">
    <span>Tên khách: </span>
    <input class="form-control" type="text" name="tenkhach" value="<?= $tenKhach?>">
  </div>

  <div class="ordered-food-list">
    <?php
      if(isset($_SESSION['monAn'])){
        if(!empty($_SESSION['monAn'])){
          foreach ($_SESSION['monAn'] as $key => $value) {
            $string = $key.':'.$value;
            $monAn .= $string.',';
          }
          foreach ($_SESSION['monAn'] as $mon => $soLuong) {
            $result = $monClass->getThongTinMonAnById($mon);
            $tong = $soLuong*$result['gia'];
            $thanhTien = $thanhTien + ($soLuong*$result['gia']);
            ?>
    <div class="food">
      <div class="food-name" style="margin-top: 30px; margin-right: -150px; margin-bottom: -45px;">
        <?= $result['ten']?>
      </div>
      <div class="food-price" style=" margin-right: -550px; margin-top: 23px; margin-bottom: -25px;"><?=$monClass->productPrice($result['gia'])?> đ</div>
      <div>
        <p style="width: 50px; height: 25px; position: absolute; left: 750px;  text-align: center;" name="soluong"><?= $soLuong?></p>
      <div class="sum-price" style="margin-left: 50px;position: absolute; left: 780px;"><?= $monClass->productPrice($tong)?> đ</div>
      <button class="delete" style="border: none; background-color: white;font-size: 25px; position: relative; left: 580px; bottom: 7px; color: red" name="delete" value="<?=$mon?>"><i class="fa fa-close"></i></button>
      </div>
    </div>
    <hr style="margin-bottom: 0px; margin-top: -20px;">
    <?php
      }
    }
  }
  if(isset($_SESSION['iddondat']) && $_SESSION['iddondat'] != ''){
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
        $monAn = new MonAn();
        $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
         $tong = $soLuong*$result['gia'];
    ?>
      <div class="food">
      <div class="food-name" style="margin-top: 30px; margin-right: -150px; margin-bottom: -45px;">
        <?= $result['ten']?>
      </div>
      <div class="food-price" style=" margin-right: -550px; margin-top: 23px; margin-bottom: -25px;"><?=$monClass->productPrice($result['gia'])?> đ</div>
      <div>
        <p style="width: 50px; height: 25px; position: absolute; left: 750px;  text-align: center;" name="soluong"><?= $soLuong?></p>
      <div class="sum-price" style="margin-left: 50px;position: absolute; left: 780px;"><?= $monClass->productPrice($tong)?> đ</div>
      <button class="delete" style="border: none; background-color: white;font-size: 25px; position: relative; left: 580px; bottom: 7px; color: red" name="delete" value="<?=$mon?>"><i class="fa fa-close"></i></button>
      </div>
    </div>
    <?php
  }
}else{
?>
  </div>
  <button style="background-color: #0040FF; border: none; margin-top: 10px; color: white; height: 35px; margin-left: 400px;border-radius: 3px 3px 3px 3px;" value="<?= $monAn?>" name = "chonMon" type="submit">Chọn món</button>
  <?php
}
?>
  <hr>
  <?php
  if (isset($_SESSION['chonPhong'])){
    if(!empty($_SESSION['chonPhong'])){
      $phong = $_SESSION['chonPhong'];
      $room = new Phong();
      $result = $room->getthongTinPhongById($_SESSION['chonPhong']);
      $thanhTien = $thanhTien + $result['gia'];
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
    <button class="delete" style="border: none; background-color: white;font-size: 25px; position: relative; left: 300px; bottom: 7px; color: red" name="deleteRoom"><i class="fa fa-close"></i></button>
  </div>
  <?php
  }
}
if(isset($_SESSION['iddondat']) && $_SESSION['iddondat'] != ''){
  if($phong != '0'){
      $room = new Phong();
      $result = $room->getthongTinPhongById($phong);
      $thanhTien = $thanhTien + $result['gia'];
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
}
else{
  ?>
  <button style="background-color: #0040FF; border: none; margin-top: 10px; color: white; height: 35px; width: 110px; margin-left: 400px;border-radius: 3px 3px 3px 3px;" name = "chonPhong" type="submit" value="<?=$phong?>">Chọn phòng</button>
  <?php
}
?>
  <br>
  <hr>
  <div class="total" style="margin-right: 430px;">
    Tổng tiền: <div class="total-price" style="position: absolute; left: 830px;"><?php
    if(isset($_SESSION['iddondat'])){
      ?>
      <?=$monClass->productPrice($tongTien)?>
    <?php
    }else{
      ?>
     <?=$monClass->productPrice($thanhTien)?>
     <?php
   }
     ?> đ</div>
  </div>
  <hr>
  <?php
  if (!empty($error1)) {
        echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px;text-align:center;margin-left:100px; margin-bottom:20px;'>$error1</div>";
    }
  ?>
  <button style="position: absolute; left: 750px; background-color: #0040FF; color: white; border: none; width: 100px; height: 30px;border-radius: 3px 3px 3px 3px;" name="tao" type="submit" form="thongtin" value="<?=$thanhTien?>">Xác nhận</button>
  <button style="position: absolute; left: 860px; background-color: #6E6E6E; color: white; border: none; width: 100px; height: 30px;border-radius: 3px 3px 3px 3px;" name="huy" type="submit">Hủy</button>
</div>
</form>
</body>
</html>