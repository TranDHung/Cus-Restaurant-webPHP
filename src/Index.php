<?php
    ob_start();
    session_destroy();
    ob_clean();
    session_start();
    require_once('AccountDB.php');
    require_once('MenuDB.php');
    require_once('Database.php');
    $timKiem = '';
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
    .order{
      float: left;
      margin-left: 250px;
      margin-top: 10px;
      background: #B40404;
      width: 450px;
      height: 150px;
      padding-top: 50px;
      text-align: center;
      font-size: 35px;
      font-family: "Times New Roman", Times, serif;
      transition: all .2s ease-in-out;
    }
    .order:hover{
      transform: scale(1.03);
    }
    .order a{
      color: white;
      text-decoration: none;
    }
    .feature{
      width: 425px;
      height: 300px;
      display: table-cell;
      margin-left: 24px;
      margin-top: 10px;
      transition: all 0.5s ease-in-out;
    }
    .feature img{
      width: 425px;
      height: 300px;
    }
    .feature button{
      border: none;
      background-color: white;
    }
    .text-feature {
      position: absolute;
      color: white;
      text-align: center;
      font-size: 45px;
      height: 75px;
      margin-top: -75px;
      width: 413px;
      background-image: linear-gradient(transparent, #04B404);
    }
    .div-feature{
      padding-left: 15px;
      display: table-cell;
    }
    .food{
      margin-left: 30px;
      margin-top: 10px;
      height: 217px;
      width: 300px;
      text-align: center;
      float: left;
    }
    .food-img{
      height: 180px;
      width: 300px;
    }
    .feature:hover{
      transform: scale(1.05);
    }
    .food-name {
      position: absolute;
      font-size: 20px;
      color: white;
      margin-top: -20px;
      height: 50px;
      text-align: center;
      width: 300px;
      background-image: linear-gradient(transparent, #173B0B);
    }
    .food-name p{
       padding-top: 17px;
    }
    button:focus {
      outline: none;
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
    .searchbar{
      width: 300px; 
      height: 40px; 
      border-top-left-radius: 3px; 
      border-bottom-left-radius: 3px; 
      border: none;
      margin-left: 100px;
      margin-top: 5px;
    }
    .searchbar:focus{
      outline: none;
    }
    .table{
      background: white;
      text-align: center;
      width: 1100px;
      border-radius: 7px;
      margin: 20px;
      padding-bottom: 3px;
      float: left;
    }
    .row-header{
      background: #B40404;
      border-top-right-radius: 7px;
      border-top-left-radius: 7px;
      color: white;
    }
    .cell{
      display: table-cell;
      padding: 15px;
      width: 170px;
    }
    .cell-icon{
      display: table-cell;
      padding: 15px;
      width: 50px;
    }
    .row{
      display: table-row;
    }
    .row hr{
      padding: 0px;
      margin: 0px;
    }
    .empty-cart{
      text-align: center;
    }
    .empty-cart-text{
      padding-top: 35px;
      font-size: 35px;
      color: #585858;
    }
    .div-of-empty{
      margin: auto;
      padding-top: 30px;
      border-radius: 8px;
      background: white;
      width: 1300px;
      height: 550px;
    }
    .cart-empty-image{
      height: 400px;
      width: 800px;
    }
  </style>
  <script type="text/javascript">
    function onclickList1(){
      var t1 = document.getElementById("kv");
      t1.style.backgroundImage = "linear-gradient(transparent, red)";
      var t2 = document.getElementById("mc");
      t2.style.backgroundImage = "linear-gradient(transparent, #04B404)";
      var t3 = document.getElementById("tm");
      t3.style.backgroundImage = "linear-gradient(transparent, #04B404)";

      var text1 = document.getElementById("danhsach1");
      text1.style.display = "block";
      var text2 = document.getElementById("danhsach2");
      text2.style.display = "none";
      var text3 = document.getElementById("danhsach3");
      text3.style.display = "none";
    }
     function onclickList2(){
      var t1 = document.getElementById("mc");
      t1.style.backgroundImage = "linear-gradient(transparent, red)";
      var t2 = document.getElementById("kv");
      t2.style.backgroundImage = "linear-gradient(transparent, #04B404)";
      var t3 = document.getElementById("tm");
      t3.style.backgroundImage = "linear-gradient(transparent, #04B404)";

      var text1 = document.getElementById("danhsach2");
      text1.style.display = "block";
      var text2 = document.getElementById("danhsach1");
      text2.style.display = "none";
      var text3 = document.getElementById("danhsach3");
      text3.style.display = "none";
    }
     function onclickList3(){
      var t1 = document.getElementById("tm");
      t1.style.backgroundImage = "linear-gradient(transparent, red)";
      var t2 = document.getElementById("mc");
      t2.style.backgroundImage = "linear-gradient(transparent, #04B404)";
      var t3 = document.getElementById("kv");
      t3.style.backgroundImage = "linear-gradient(transparent, #04B404)";

      var text1 = document.getElementById("danhsach3");
      text1.style.display = "block";
      var text2 = document.getElementById("danhsach2");
      text2.style.display = "none";
      var text3 = document.getElementById("danhsach1");
      text3.style.display = "none";
    }
    function showContact(){
    document.getElementById("contactInfo").style.display = "block";
    }
    function hideContact(){
      document.getElementById("contactInfo").style.display = "none";
    }
  </script>
  <?php
    if(isset($_POST['xemthongtintimkiem'])){
      $_SESSION['dontimkiem'] = $_POST['xemthongtintimkiem'];
      header('Location: ViewOrder.php');
    }
  ?>
</head>

<nav class="navbar navbar-expand-sm" style="background-color: #B40404;">
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="10px"></a>
    <form method="post" id="timkiem"><input class="searchbar" type="text" name="noidung" placeholder="Tìm kiếm món ăn, đơn đặt"><button type="submit" style="border: none; border-top-right-radius: 3px; border-bottom-right-radius: 3px; height: 40px; width: 100px;" name="timkiem" form="timkiem" value="<?=$timKiem?>">Tìm kiếm</button></form>
      <ul class="navbar-nav" style="padding-left: 60px; font-size: 20px">
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
    if(isset($_POST['noidung'])){
      $path = '';
      $timKiem = $_POST['noidung'];
      $_SESSION['infor'] = $_POST['noidung'];
      $mon = new MonAn();
      $result = $mon->getThongTinTimKiem($_SESSION['infor']);
      if(!is_numeric($_SESSION['infor'])){
        if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                if($row['vitri'] == 1){
                  $path = 'Image/khaivi/';
                }else if($row['vitri'] == 2){
                  $path = 'Image/monchinh/';
                }else{
                  $path = 'Image/trangmieng/';
                }
  ?>
  <div class="food">
      <img class="food-img" src="<?=$path.''.$row['anh']?>">
      <div class="food-name"><p><?=$row['ten']?></p></div>
  </div>
  <?php
  }
  }else{
    ?>
   <div class="div-of-empty" >
      <div class="empty-cart">
        <img class="cart-empty-image" src="Image/emptyCart.png">
        <p class="empty-cart-text">Không tìm thấy món ăn</p>  
      </div>
    </div><br>
    <?php
  }
  }else{
    if ($result->num_rows > 0) {
    ?>
    <div class="table">
    <div class="row-header">
      <div class="cell">ID</div>
      <div class="cell">Tên khách</div>
      <div class="cell">Số điện thoại</div>
      <div class="cell">Loại đơn</div>
      <div class="cell">Ngày đặt</div>
      <div class="cell">Số lượng khách</div>
      <div class="cell-icon"></div>
    </div>
    <?php
      while($row = $result->fetch_assoc()) {
        ?>
    <div class="row">
      <form method="post" id="thongtintimkiem">
      <div class="row-content">
      <div class="cell"><?= $row['id'] ?></div>
      <div class="cell"><?= $row['tenkhach'] ?></div>
      <div class="cell"><?= $row['sdt'] ?></div>
      <div class="cell"><?= $row['loaidon']?></div>
      <div class="cell"><?= $row['ngaydat'] ?></div>
      <div class="cell"><?= $row['slkhach'] ?></div>
      <div class="cell-icon"><button type="submit" form="thongtintimkiem" style="background-color:white; border: none;" name="xemthongtintimkiem" value="<?= $row['id'] ?>"><span class="fa fa-eye"></span></button></div>
    </form>
    </div>
    <hr>
    <?php
      }
    ?>
    </div>
  </div>
    <?php
  }else{
    ?>
   <div class="div-of-empty" >
      <div class="empty-cart">
        <img class="cart-empty-image" src="Image/emptyCart.png">
        <p class="empty-cart-text">Không có đơn hàng cần tìm</p>
      </div>
    </div><br>
    <?php
  }
  }
}else{
?>
    <div id="slideshow" style="padding-top: 0px;">
      <div class="slide-wrapper">
        <div class="slide"><img class = "img" src="Image/slide1.jpg"></div>
        <div class="slide"><img class = "img" src="Image/slide2.jpg"></div>
        <div class="slide"><img class = "img" src="Image/slide4.jpg"></div>
        <div class="slide"><img class = "img" src="Image/slide5.jpg"></div>
      </div>
    </div>
<body>
  <div class="order">
    <a href="BookingParty.php">
      <i class='fas fa-glass-cheers'></i>
      <span>ĐẶT TIỆC</span>
    </a>
  </div>
  <div class="order" style="margin-left: 10px;">
    <a href="BookingTable.php">
      <i class='fas fa-utensils'></i>
      <span>ĐẶT BÀN</span>
    </a>
  </div>
  <form method="post">
  <div style="text-align: center; padding-left: 8px;">
    <h2 class="line" style="margin-top: 190px; margin-bottom: 25px;"><span>Món ăn</span></h2>
  <div class="div-feature">
    <div class="feature">
      <button name="khaivi" value = '1' id="khaivi" type="button" onclick="onclickList1()">
        <img src="Image/khaivi.jpg" >
        <div class="text-feature" style="padding-left: 140px; padding-right: 140px;" id="kv"><span>Khai vị</span></div>
      </button>
    </div>
  </div>
  <div class="div-feature">
    <div class="feature">
      <button name="monchinh" value = '2' type="button" id="monchinh" onclick="onclickList2()">
      <img src="Image/chinh.jpg">
      <div class="text-feature" style="padding-left: 95px; padding-right: 95px;" id="mc"><span>Món chính</span></div>
      </button>
    </div>
  </div>
  <div class="div-feature">
    <div class="feature">
      <button name="trangmieng" value = '3' type="button" id="trangmieng" onclick="onclickList3()">
      <img src="Image/trangmieng.jpg">
      <div class="text-feature" style="padding-left: 75px; padding-right: 75px;" id="tm"><span>Tráng miệng</span></div>
      </button>
    </div>
  </div>
  </div>
</form>
  <div style="display:none; overflow: auto;" id="danhsach1">
  <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Khai vị</span></h2>
  <?php
    $vitri = 1;
    $path = 'Image/khaivi/';
    $monan = new MonAn();
    $result = $monan->getDanhSachMonAnByVitri($vitri);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
  ?>
  <div class="food">
      <img class="food-img" src="<?=$path.''.$row['anh']?>">
      <div class="food-name"><p><?=$row['ten']?></p></div>
  </div>
  <?php
  }
}
?>
</div>
<div style="display:none; overflow: auto;" id="danhsach2">
  <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Món chính</span></h2>
  <?php
    $vitri = 2;
    $path = 'Image/monchinh/';
    $monan = new MonAn();
    $result = $monan->getDanhSachMonAnByVitri($vitri);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
  ?>
  <div class="food">
      <img class="food-img" src="<?=$path.''.$row['anh']?>">
      <div class="food-name"><p><?=$row['ten']?></p></div>
  </div>
  <?php
  }
}
?>
</div>
<div style="display:none; overflow: auto;" id="danhsach3">
  <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Tráng miệng</span></h2>
  <?php
    $vitri = 3;
    $path = 'Image/trangmieng/';
    $monan = new MonAn();
    $result = $monan->getDanhSachMonAnByVitri($vitri);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
  ?>
  <div class="food">
      <img class="food-img" src="<?=$path.''.$row['anh']?>">
      <div class="food-name"><p><?=$row['ten']?></p></div>
  </div>
  <?php
  }
}
?>
</div>
<div class="party-image" style="padding: 22px; position: relative;">
  <h2 class="line"></h2>
  <h1 style="text-align: center; margin-bottom: 10px;">Một số hình ảnh tại nhà hàng</h1>
  <img style="height: 400px; width: 500px;" src="Image/hinh1.jpg">
  <img style="width: 800px; height: 400px;" src="Image/hinh2.jpg">
  <img style="margin-top: 5px; width: 432px; height: 270px;" src="Image/hinh3.jpg">
  <img style="margin-top: 5px; width: 432px; height: 270px;" src="Image/hinh4.jpg">
  <img style="margin-top: 5px; width: 432px; height: 270px;" src="Image/hinh5.jpg">
</div>
<img style="margin-top: 50px;" src="Image/kCNPVd.jpg">
</body>
<?php
}
?>
</html>