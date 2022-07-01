<?php
    session_start();
    require_once('Database.php');
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
    }
    .navbar-expand-sm{
      background-color: #58ACFA;
    }
  </style>

  <?php
    $taiKhoan = new QuanLy();
    $thongTinNhanVien = $taiKhoan->getthongTinNhanVienById($_SESSION['id']);
    if($thongTinNhanVien == null){
      session_destroy();
      header('Location: Login.php');
    }
    $id = '';
    $bdate = $_SESSION['ngaysinh'];
    $ho = $_SESSION['ho'];
    $ten = $_SESSION['ten'];
    $gioi = $_SESSION['gioi'];
    
    $newPass = '';
    $newPass_confirm = '';
    $curPass = '';
    $check = false;
    $check1 = false;
    $error = '';
    $infor = '';
    $error1 = '';
    $object = [];
    if (isset($_POST['birthd']) &&  isset($_POST['ten']) && isset($_POST['gioi']) && isset($_POST['ho']))
    {
        $id = $_SESSION['id'];
        $bdate = $_POST['birthd'];
        $ten = $_POST['ten'];
        $ho = $_POST['ho'];
        $gioi = $_POST['gioi'];
        
        if (empty($ten)) {
            $error = 'Nhập tên nhân viên';
        }
        else if (empty($bdate)) {
            $error = 'Nhập ngày sinh';
        }
        else if (empty($ho)) {
            $error = 'Nhập họ nhân viên';
        }
        else {
            // edit account
            $nhanvien = new NhanVien();
            $object['id'] = $id;
            $object['ho'] = $ho;
            $object['ten'] = $ten;
            $object['ngays'] = $bdate;
            $object['gioi'] = $gioi;
           $result = $nhanvien->chinhSuaThongTinCaNhan($object);
           if ($result['code'] == 0){
              $check = true;
              $infor = 'Chỉnh sửa thông tin thành công';
              $_SESSION['ngaysinh'] = $bdate;
              $_SESSION['ho'] = $ho;
              $_SESSION['ten'] = $ten;
              $_SESSION['fullName'] = $ho.''.$ten;
              $_SESSION['gioi'] = $gioi;
           }else{
               $infor = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }
        }
    }else if(isset($_POST['curPass']) &&  isset($_POST['newPass']) && isset($_POST['newPass_confirm'])){

        $userName = $_SESSION['userName'];
        $curPass = $_POST['curPass'];
        $newPass = $_POST['newPass'];
        $newPass_confirm = $_POST['newPass_confirm'];
        $checkPass = checkPass($userName,$curPass);

        if (empty($curPass)) {
            $error1 = 'Nhập mật khẩu hiện tại';
        }
        else if (empty($newPass)) {
            $error1 = 'Nhập mật khẩu mới';
        }
        else if (empty($newPass_confirm)) {
            $error1 = 'Nhập mật khẩu xác nhận';
        }
        else if (strlen($newPass) < 6) {
            $error1 = 'Mật khẩu mới phải nhiều hơn 6 kí tự';
        }
        else if ($newPass!= $newPass_confirm) {
            $error1 = 'Mật khẩu không khớp';
        }
        else if($checkPass == false){
            $error1 = 'Mật khẩu hiện tại không đúng';
        }
        else {
            // change password
          $quanly = new NhanVien();
           $result = $quanly->doiMatKhau($userName,$newPass);
           if ($result['code'] == 0){
              $check1 = true;
               $infor = 'Đổi mật khẩu thành công';
               header('Location: Logout.php');
           }else{
               $infor = 'Xảy ra lỗi. Vui lòng thử lại sau';
           }

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
            <a class="nav-link" href="EditProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">Hồ sơ cá nhân</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">Đăng xuất</a>
          </li>
        </ul>
    </nav>
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <form method="post">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thay đổi thông tin cá nhân</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Họ</label><input name="ho" type="text" class="form-control" placeholder="" value="<?= $ho?>"></div>
                     <div class="col-md-12"><label class="labels">Tên</label><input name="ten" type="text" class="form-control" placeholder="" value="<?= $ten?>"></div>
                    <div class="col-md-12"><label class="labels">Ngày sinh</label><input name="birthd" type="date" class="form-control" placeholder="" value="<?= $bdate?>"></div>
                    <div class="col-md-12"><label class="labels">Giới tính</label>
                      <label class="radio-inline" style="padding-right: 100px">
                        <input type="radio" name="gioi" value="1"
                        <?php
                          if($gioi == 1){
                            ?>
                            checked
                            <?php
                          }
                          ?>
                        >Nam
                      </label>
                      <label class="radio-inline" style="padding-right: 100px">
                        <input type="radio" name="gioi" value="2"
                        <?php
                          if($gioi == 2){
                            ?>
                            checked
                            <?php
                          }
                          ?>
                        >Nữ
                      </label>
                    </div>
                    
                </div>
                <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                    ?>
                <?php
                    if(!$check)
                        ?>
                        <div class="mt-2 text-center"><button class="btn btn-success float-right">Thay đổi thông tin</button></div>
                    <?php
                    if($check)
                         echo "<div class='alert alert-success' style= 'text-align:center;'>$infor</div>";
                ?>
            </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 py-5">
                <form method="post">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thay đổi mật khẩu</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mật khẩu cũ</label><input name="curPass" type="password" class="form-control" placeholder="Nhập mật khẩu cũ" value="<?= $curPass ?>"></div>
                    <div class="col-md-12"><label class="labels">Mật khẩu mới</label><input name="newPass"type="password" class="form-control" placeholder="Nhập mật khẩu mới" value="<?= $newPass ?>"></div>
                    <div class="col-md-12"><label class="labels">Xác nhận MK mới</label><input name="newPass_confirm" type="password" class="form-control" placeholder="Nhập mật khẩu mới" value="<?= $newPass_confirm?>"></div>
                </div>
                <?php
                            if (!empty($error1)) {
                                echo "<div class='alert alert-danger' style= 'text-align:center;'>$error1</div>";
                            }
                    ?>
                <?php
                    if(!$check1)
                        ?>
                        <div class="mt-4 text-center"><button class="btn btn-success float-right">Thay đổi mật khẩu</button></div>
                    <?php
                    if($check1)
                        echo "<div class='alert alert-success' style= 'text-align:center;'>$infor</div>";
                ?>

            </form>
        </div>
        
    </div>
</div>
</body>