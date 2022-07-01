<?php
  session_start();
  require_once('Database.php');
  require_once('AccountDB.php');
  if(isset($_SESSION['ten']) && isset($_SESSION['sdt']) && isset($_SESSION['ngay']) && isset($_SESSION['gio']) && isset($_SESSION['soluongkhach']) && isset($_SESSION['iddondat'])){
      unset($_SESSION['ten']);
      unset($_SESSION['sdt']);
      unset($_SESSION['ngay']);
      unset($_SESSION['gio']);
      unset($_SESSION['soluongkhach']);
      unset($_SESSION['iddondat']);
  }
  if(isset($_SESSION['iddondat'])){
     unset($_SESSION['iddondat']);
  }
  $taiKhoan = new QuanLy();
  $thongTinNhanVien = $taiKhoan->getthongTinNhanVienById($_SESSION['id']);
  if($thongTinNhanVien == null){
    session_destroy();
    header('Location: Login.php');
  }
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
  <style type="text/css" href="style.css">
    body{
        font-family: Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
        background: lightgray;
    }
    .row-management{
      display: table-cell;
      padding-left: 30px;
      padding-top: 10px;
      text-align: center;
      align-content: center;
    }
    .row-content{
      width: 600px;
      height: 250px;
      margin: 15px;
      border-radius: 120px;
      background: white;
    }
    .row-content:hover{
      box-shadow: 3px 3px 2px gray;
      background: #EFFBFB;
    }
    .row-content:hover .icon{
      margin-left: -180px; 
    }
    .row-content:hover .animation-text{
      visibility: visible;
      opacity: 1;
    }
    .icon{
      padding-top: 0px;
      margin-bottom: -50px;
      font-size: 130px;
      margin-left: 0px;
      transition: margin-left 0.3s; 
    }
    .animation-text{
      float: right;
      color: black;
      font-size: 30px;
      padding-top: 60px;
      margin-left: -300px;
      margin-right: 130px;
      width: 170px;
      visibility: hidden;
      opacity: 0;
      font-weight: bold;
      transition: visibility 0s, opacity 1.5s;
    }
    .quantity{
      font-weight: bold;
      font-size: 25px;
      color: black;
      padding-top: 40px;
    }
    .navbar-expand-sm{
      background-color: #58ACFA;
    }

  </style>
  <?php
    $soMon = getTongSoMonAn();
    $soPhong = getTongSoPhong();
    $soNhanVien = getTongSoNhanVien();
    $soDonDat = getTongSoDonDat();
    $soHoaDon = getTongSoHoaDon();
    $soHoaDonChuaThanhToan = getTongSoDonDatChoThanhToan();

  ?>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-infor">
    <a href="indexManager.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="195px" height="45px"></a>
    <a class="navbar-brand" href="indexManager.php"><h3 style="color:white; margin-top: 1px"></h3></a>

      <ul class="navbar-nav" style="padding-left: 710px; font-size: 20px">
            <li class="nav-item">
            <a href="indexManager.php" class="navbar-brand"><i class = "management"><img src="Image/management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Quản Lý</div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="EditProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>
  <?php
    if($_SESSION['loaiTaiKhoan'] == 1){
  ?>
  <div class="row-management">
    <div class="row-content">
      <a href="indexMaAccount.php">
        <div class="icon">
                <span class="fas fa-user-circle"></span>
                <h1 class="animation-text">Quản lý Nhân Viên</h1>
        </div>
      </a>
      <div class="quantity"><?= $soNhanVien ?> Nhân Viên</div>
    </div>
    <div class="row-content">
      <a href="indexMaMenu.php">
        <div class="icon">
                <span class="fas fa-concierge-bell"></span>
                <h1 class="animation-text">Quản lý thực đơn</h1>
        </div>
      </a>
      <div class="quantity"><?= $soMon ?> Món ăn</div>
    </div>
    <div class="row-content">
      <a href="indexMaOrder.php">
        <div class="icon">
                <span class="far fa-file-alt"></span>
                <h1 class="animation-text">Quản lý đơn đặt</h1>
        </div>
      </a>
      <div class="quantity"><?= $soDonDat ?> Đơn đặt</div>
    </div>
  </div>
  <div class="row-management">
    <div class="row-content">
      <a href="indexMaRoom.php">
        <div class="icon">
                <span class="fas fa-door-open"></span>
                <h1 class="animation-text">Quản lý phòng</h1> 
        </div>
      </a>
      <div class="quantity"><?= $soPhong ?> Phòng</div>
    </div>
    <div class="row-content">
      <a href="indexMaBill.php">
        <div class="icon">
                <span class="fas fa-money-check-alt"></span>
                <h1 class="animation-text">Quản lý hóa đơn</h1>
        </div>
      </a>
      <div class="quantity"><?= $soHoaDon ?> Hóa đơn</div>
    </div>
    <div class="row-content">
      <a href="indexMaPay.php">
        <div class="icon">
                <span class="fas fa-dollar-sign"></span>
                <h1 class="animation-text">Thanh toán đơn đặt</h1> 
        </div>
      </a>
      <div class="quantity"><?= $soHoaDonChuaThanhToan ?> Đơn đặt chưa thanh toán</div>
    </div>
  </div>
  <?php
}else{
?>
  <div class="row-management">
    <div class="row-content">
      <a href="indexMaBill.php">
        <div class="icon">
                <span class="fas fa-money-check-alt"></span>
                <h1 class="animation-text">Quản lý hóa đơn</h1>
        </div>
      </a>
      <div class="quantity"><?= $soHoaDon ?> Hóa đơn</div>
    </div>
  </div>
  <div class="row-management">
    <div class="row-content">
      <a href="indexMaPay.php">
        <div class="icon">
                <span class="fas fa-dollar-sign"></span>
                <h1 class="animation-text">Thanh toán đơn đặt</h1> 
        </div>
      </a>
      <div class="quantity"><?= $soHoaDonChuaThanhToan ?> Đơn đặt chưa thanh toán</div>
    </div>
  </div>
<?php
}
?>
</body>
</html>