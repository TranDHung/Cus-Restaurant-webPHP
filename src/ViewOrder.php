<?php
  ob_start();
  session_start();
  require('RoomDB.php');
  require('MenuDB.php');
  require('TheOrderDB.php');
  require('AccountDB.php');
  ob_flush();
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
    body{
      font-family: Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background: #F2F2F2;
    }
    .field{
      padding-bottom: 30px;
      padding-right: 10px;
      margin-bottom: 25px;
    }
    .field span{
      float: left;
      padding-top: 17px;
      margin-top: -10px;
      margin-left: 750px;
    }
    .form-control{
      border-radius: 5px;
      margin-right: 100px;
      margin-bottom: -10px;
      float: right;
      width: 300px;
    }
    .short-line{
      width: 1200px;
    }
    .form-control:focus {
    box-shadow: 1px;
    border-color: #01A9DB;
    }
    .food-list{
      display: inline-grid;
    }
    .food{
      margin-left: 30px;
      margin-top: 10px;
      height: 217px;
      width: 300px;
      border: 1px solid black;
      text-align: center;
      float: left;
    }
    .food-img{
      height: 180px;
      width: 300px;
    }
    .soluong{
      position: absolute;
      width: 299px;
      height: 36px;
      color: white;
      border: 1px solid black;
      padding-top: 3px;
      padding-bottom: 2px;
      background: #8A0808;
      padding-left: -10px;
    }
    .quantity{
      width: 40px;
      height: 20px;
      text-align: center;
    }
    .text-cost {
      position: absolute;
      color: white;
      background: red;
      margin-top: -180px;
      padding-left: 10px;
      padding-right: 10px;
      font-weight: bold;
    }
    .room .text-cost {
      margin-top: -235px;
    }
    .food-name {
      position: absolute;
      font-size: 20px;
      color: white;
      margin-top: -30px;
      text-align: center;
      width: 299px;
      background-image: linear-gradient(transparent, #DF0101);
    }
    .room .food-name{
      width: 368px;
    }
    .room-list{
      display: table-cell;
    }
    .room{
      margin-left: 70px;
      margin-top: 10px;
      height: 237px;
      width: 370px;
      border: 1px solid black;
      text-align: center;
      float: left;
    }
    .room-img{
      height: 235px;
      width: 370px;
    }
    .title-cart img{
      width: 1349px;
    }
    .confirm-payment{
      width: 350px;  
      z-index: 10; 
      position: absolute;
      text-align: center;
      border-radius: 20px;
      left: 0; 
      top: 0; 
      height: 200px;
      margin-top: 160px;
      margin-left: 130px;
    }
    .total-bill{
      padding: 20px;
      color: black;
    }
    .price-total-in-cart{
      color: black;
      font-size: 35px;
    }
    .confirm-btn{
      background: white;
      color: red;
      margin-top: 10px;
      font-weight: bold;
      height: 50px;
      border-radius: 10px;
      border: none;
    }
    .line{
        width: 800px;
        margin: auto;
        margin-bottom: 20px;
        margin-top: 10px;
      }
    .line span{
      background-color: #F2F2F2;
      margin: 10px;
      font-size: 25px;;
    }
    .delete{
      position: relative;  
      bottom: 177px; 
      left: 130px;
      vertical-align: center;
      height: 26px;
    }
    
    .fa-close{
      color: red; 
      font-size: 20px; 
    }
    
    #sdt::-webkit-outer-spin-button,
    #sdt::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    button:focus {
      outline: none;
    }
    .fa-minus{
      padding-left: 20px;
    }
    .confirm-update{
      text-align: right;
      padding-right: 30px;
    }
    .confirm-btn{
      background: #0040FF;
      color: white;
      margin-top: 10px;
      margin-bottom: 30px;
      font-weight: bold;
      border-radius: 5px;
      height: 40px;
      width: 100px;
      border: none;
    }
    .themMon{
      background:green;
      width: 97px;
      border-radius: 3px 3px 3px 3px;
    }
    .doiPhong{
      background: green;
      width: 97px;
      border-radius: 3px 3px 3px 3px;
    }
    #sokhach::-webkit-outer-spin-button,
    #sokhach::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .return-btn{
      background: lightgray;
      margin-left: 8px;
      color: black;
      margin-top: 10px;
      margin-bottom: 30px;
      font-weight: bold;
      border-radius: 5px;
      height: 40px;
      width: 100px;
      border: none;
    }
    .contact-info{
        width: 300px;
        height: 220px;
        margin-top: -10px;
        margin-right: 5px;
        padding: 45px;
        padding-top: 35px;
        position: fixed;
        right: 0;
        display: none;
        background-image: url("Image/hoavan.jpg");
        border-radius: 15px;
        color: white;
        box-shadow: 0 0 5px 0 #ccc;
      }
  </style>
  <script type="text/javascript">
    function showContact(){
      document.getElementById("contactInfo").style.display = "block";
      }
      function hideContact(){
        document.getElementById("contactInfo").style.display = "none";
      }
  </script>
</head>
<nav class="navbar navbar-expand-sm" style="background-color: #B40404;">
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="60px"></a>
      <ul class="navbar-nav" style="padding-left: 520px; font-size: 20px">
          <li class="nav-item">
            <a class="nav-link" href="DichVu.php" style="color:white;">Dịch vụ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ViewMenu.php" style="padding-left: 30px;color:white;">Thực đơn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="BookingTable.php" style="padding-left: 30px;color:white;">Đặt bàn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="BookingParty.php" style="padding-left: 30px;color:white;">Đặt tiệc</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link" onmouseover="showContact()" onmouseleave="hideContact()" style="margin-top: 2px;padding-left: 30px;color:white;">Thông tin</a>
          </li>
        </ul>
    </nav>
    <div class="contact-info" id="contactInfo">
    45 - 47 - 49 Lê Quý Đôn, P7, Q. 3, TP.HCM
    <br>
    Phản hồi dịch vụ - hóa đơn: <br>1800 799 988
    <br>
    Email:<br> vietphosale@vietphogroup.vn 
  </div>
<?php
    $donDat = new DonDat();
    $result = $donDat->getthongTinDonDatById($_SESSION['dontimkiem']);
    $id = $result['id'];
    $tenKhach = $result['tenkhach'];
    $sdt = $result['sdt'];
    $ngay = $result['ngaydat'];
    $gio = $result['giodat'];
    $phong = $result['phong'];
    $monAn = $result['monan'];
    $soKhach = $result['slkhach'];
    $loaiDon = $result['loaidon'];
    $thanhTien = $result['tongtien'];
    $danhSach = explode(',',$monAn);
    $danhSachMonAn = [];
    $danhSachSoLuong = [];
    $object = [];
    $error1 = '';
    foreach ($danhSach as $mon) {
      $monVaSoLuong = explode(':',$mon);
      if(!empty($monVaSoLuong[1])){
        array_push($danhSachMonAn, $monVaSoLuong[0]);
        array_push($danhSachSoLuong, $monVaSoLuong[1]);
      }
    }
?>
</head>
<body>
  <form method="post" id="capNhat">
  <div class="customer-info">
    <div class="title-cart" style="margin-top: 20px;">
      <img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-custom-info.png">
    </div><hr class="short-line">
    <div class="field">
      <span>Họ và Tên:</span>
      <input class="form-control" type="text" readonly value="<?=$tenKhach?>" name="tenkhach">
    </div>
    <div class="field">
      <span>Số điện thoại:</span>
      <input class="form-control" type="number" readonly value="<?= $sdt?>" id="sdt" name="sdt">
    </div>
    <div class="field">
      <span>Ngày đặt:</span>
      <input class="form-control" type="date" readonly value="<?= $ngay?>" name="ngay">
    </div>
    <div class="field">
      <span>Giờ đặt:</span>
      <input class="form-control" type="time" readonly value="<?= $gio?>" name="gio">
    </div>
    <div class="field">
      <span>Số lượng khách:</span>
      <input class="form-control" type="number" readonly value="<?= $soKhach?>" name="sokhach" id="sokhach">
  </div>
  <hr>
  <div class="food-list" style="overflow: auto;">
    <div class="title-cart">
      <img src="Image/dishes.png">
    </div><hr class="short-line">
    <div class="div-khaivi">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Khai vị</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'kv'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
      ?>
      <div class="food">
        <img class="food-img" src="Image/khaivi/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="div-chinh">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Món chính</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'mc'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
      ?>
      <div class="food">
        <img class="food-img" src="Image/monchinh/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="div-trangmieng">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Tráng miệng</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'tm'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
      ?>
      <div class="food">
        <img class="food-img" src="Image/trangmieng/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
  <?php
    if($phong != '0'){
      $room = new Phong();
      $result = $room->getthongTinPhongById($phong);
      if($result['kieuphong'] == 1){
        $ten = 'PHÒNG VIP';
      }else{
        $ten = 'PHÒNG THƯỜNG';
      }
    ?>
    <hr>
  <div class="room-list">
    <div class="title-cart">
      <img src="Image/room.png">
    </div><hr class="short-line">
    <div class="room" style="margin-left: 485px;">
      <img class="room-img" src="Image/phong/<?= $result['anh']?>">
      <div class="text-cost"><?= $room->productPrice($result['gia'])?> đ</div>
      <div class="food-name"><span><?= $ten?></span></div>
    </div>
  </div>
  <?php
  }
  ?>
  </form>
  <hr>
  <div class="confirm-payment">
    <div class="div-of-total">
      <div class="total-bill">
        Tổng số tiền: 
      </div>
      <div class="price-total-in-cart"><?= $monAn->productPrice($thanhTien)?> đ</div>
    </div>
  </div>
  <div class="confirm-update">
    <div class="div-of-total">
      <a href="Index.php">Quay lại</a>
    </div>
  </div>
</body>
</html>