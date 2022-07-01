<?php
    session_start();
    require_once('AccountDB.php');
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
    .table{
      background: white;
      text-align: center;
      width: 900px;
      border-radius: 7px;
      margin: 20px;
      padding-bottom: 3px;
      float: left;
    }
    .row-header{
      background: #58ACFA;
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
    .circle {
      margin-top: 35px;
      width: 50px;
      height: 50px;
      line-height: 50px;
      border-radius: 50%;
      font-size: 25px;
      background: white;
      float: left;
    }
    .fa-plus{
      padding-top: 12px;
      color: #58ACFA;
    }
    .circle:hover{
      width: 51px;
      height: 51px;
      box-shadow: 1px 2px gray;
    }
  </style>
  <script type="text/javascript">
  </script>
  <?php
    if(isset($_POST['deleteConfirm'])) {
        $quanly  = new QuanLy();
        $id = $_POST['deleteConfirm'];
        $quanly->xoaPhong($id);
        header('Location: IndexMaRoom.php');
    }
    if(isset($_POST['editConfirm'])) {
        $_SESSION['idroom'] = $_POST['editConfirm'];
        header('Location: EditRoom.php');
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
            <a class="nav-link" href="EditProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>
    <div class="table">
  <div class="row-header">
    <div class="cell">ID</div>
    <div class="cell">Loại phòng</div>
    <div class="cell">Giá</div>
    <div class="cell">Sức chứa</div>
    <div class="cell">Ảnh</div>
    <div class="cell-icon"></div>
    <div class="cell-icon"></div>
  </div>
  <div class="row">
  <?php
    $quanly = new QuanLy();
    $result = $quanly->quanLyPhong();
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

            ?>
    <form method="post" id="form" action="">
    <div class="row-content">
    <div class="cell"><?= $row['id'] ?></div>
    <div class="cell"><?= $row['kieuphong'] ?></div>
    <div class="cell"><?= $row['gia'] ?></div>
    <div class="cell"><?= $row['succhua'] ?></div>
    <div class="cell"><?= $row['anh'] ?></div>
    <div class="cell-icon"><button type="submit" style="background-color:white; border: none;" name="editConfirm" value="<?= $row['id'] ?>"><span class="fa fa-wrench"></span></button></div>
    <div class="cell-icon"><button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" type="submit" style="background-color:white; border: none;" name="deleteConfirm" value="<?= $row['id'] ?>"><span class="fa fa-close" style="color: red"></span></button></div>
  </div>
  
  </form>
  <hr>
      <?php
    }
  }
?>


  </div>
</div>
<div class="circle"><a href="AddRoom.php"><span class="fa fa-plus"></span></a></div>

</body>
</html>