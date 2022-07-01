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
    .field{
      padding-bottom: 30px;
      padding-right: 10px;
      margin-bottom: 25px;
    }
    .field span{
      float: left;
      padding-top: 17px;
      margin-top: -10px;

    }
    .form-create{
      width: 500px;
      height: 600px;
      background: white;
      border-radius: 25px;
      padding-left: 20px;
      padding-top: 15px;
      margin: auto;
      margin-top: 20px;
    }
    .text-create{
      font-size: 30px;
      font-weight: bold;
      background: #58ACFA;
      margin-left: -20px;
      margin-top: -20px;
      padding: 10px;
      padding-left: 20px;
      border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      color: white;
    }
    .form-control{
      border-radius: 5px;
      margin-right: 25px;
      margin-bottom: -10px;
      float: right;
      width: 300px;
    }
    .create-btn, .return-btn{
      margin-left: 148px;
      background: #2E64FE;
      color: white;
      height: 40px;
      border-radius: 7px;
      border: none;
    }
    .return-btn{
      background: lightgray;
      margin-left: 8px;
      color: black;
      width: 70px;
    }
    .form-control:focus {
    box-shadow: 1px;
    border-color: #01A9DB;
  }
  </style>

  <?php
    $id ='';
    $ho = '';
    $ten = '';
    $ngays = '';
    $gioi = '';
    $userName = '';
    $pass = '';
    $type = '';
    $error1 = '';
    $infor = '';
    $object = [];
    if(isset($_POST['submit']) && isset($_POST['id']) &&  isset($_POST['ho']) && isset($_POST['ten']) && isset($_POST['ngaysinh']) && isset($_POST['gioi']) && isset($_POST['userName'])&& isset($_POST['password'])&& isset($_POST['type'])){

        $id =$_POST['id'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $ngays = $_POST['ngaysinh'];
        $gioi = $_POST['gioi'];
        $userName = $_POST['userName'];
        $pass = $_POST['password'];
        $type = $_POST['type'];

        if (empty($id)) {
            $error1 = 'Nhập ID của nhân viên';
        }
        else if (empty($ho)) {
            $error1 = 'Nhập họ nhân viên';
        }
        else if (empty($ten)) {
            $error1 = 'Nhập tên nhân viên';
        }
        else if (empty($ngays)) {
            $error1 = 'Nhập ngày sinh của nhân viên';
        }
        else if (empty($gioi)) {
            $error1 = 'Nhập giới tính nhân viên';
        }
        else if (empty($userName)) {
            $error1 = 'Nhập tên đăng nhập của nhân viên';
        }
        else if (empty($pass)) {
            $error1 = 'Nhập mật khẩu tài khoản nhân viên';
        }
        else if (empty($type)) {
            $error1 = 'Nhập kiểu tài khoản';
        }
        else {
            $quanly = new QuanLy();
            $object['id'] = $id;
            $object['ho'] = $ho;
            $object['ten'] = $ten;
            $object['ngays'] = $ngays;
            $object['gioi'] = $gioi;
            $object['userName'] = $userName;
            $object['pass'] = $pass;
            $object['type'] = $type;
            $result = $quanly->dangKy($object);
           if ($result['code'] == 0){
               $infor = 'Thêm thông tin thành công';
               header('Location: IndexMaAccount.php');
           }else if($result['code'] == 1){
              $error1 = 'Tên đăng nhập đã tồn tại';
           }
           else{
               $error1 = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }
        }
    }
    if(isset($_POST['reset'])){
      header('Location: AddAccount.php');
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
    <form class="form-create" method="post">
    <div class="text-create">Thêm tài khoản</div>
    <div class="field" style="margin-top: 15px;">
      <span>ID: </span>
      <input type="text" name="id" class="form-control" value="<?= $id?>">
    </div>
    <div class="field">
      <span>Họ: </span>
      <input type="text" name="ho" class="form-control" value="<?= $ho?>">
    </div>
    <div class="field">
      <span>Tên: </span>
      <input type="text" name="ten" class="form-control" value="<?= $ten?>">
    </div>
    <div class="field">
      <span>Ngày sinh: </span>
      <input type="date" name="ngaysinh" class="form-control" value="<?= $ngays?>">
    </div>
    <div class="field" style="padding-bottom: 1px;margin-bottom: 15px">
      <span>Giới tính: </span>
       <label class="radio-inline" style="padding-right: 100px;padding-left: 50px">
          <input type="radio" name="gioi" value="1" checked>Nam
        </label>
        <label class="radio-inline" style="padding-right: 100px">
          <input type="radio" name="gioi" value="2">Nữ
        </label>
    </div>
    <div class="field">
      <span>Tên đăng nhập: </span>
      <input type="text" name="userName" class="form-control" value="<?= $userName?>">
    </div>
    <div class="field">
      <span>Mật khẩu: </span>
      <input type="password" name="password" class="form-control" value="<?= $pass?>">
    </div>
    <div class="field">
      <span>Kiểu tài khoản: </span>
      <input type="number" name="type" class="form-control" value="<?= $type?>" min="1" max="2" placeholder="1.Quản Lý, 2.Thu ngân">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px'>$error1</div>";
        }
        if (!empty($infor)) {
            echo "<div style = 'width: 440px;background-color:#58FA82;border-radius:4px 4px 4px 4px'>$infor</div>";
        }
    ?>
    <div style="padding-top: 10px;">
    <a href="IndexMaAccount.php" style="float: left; padding-top: 5px;">Quay lại</a>
    <button class="create-btn" type="submit" name="submit">Thêm tài khoản</button>
    <button class="return-btn" name="reset">Reset</button>
    <div>
  </form>
</body>
</html>