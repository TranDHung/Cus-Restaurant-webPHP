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
            $error = 'Nh???p t??n nh??n vi??n';
        }
        else if (empty($bdate)) {
            $error = 'Nh???p ng??y sinh';
        }
        else if (empty($ho)) {
            $error = 'Nh???p h??? nh??n vi??n';
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
              $infor = 'Ch???nh s???a th??ng tin th??nh c??ng';
              $_SESSION['ngaysinh'] = $bdate;
              $_SESSION['ho'] = $ho;
              $_SESSION['ten'] = $ten;
              $_SESSION['fullName'] = $ho.''.$ten;
              $_SESSION['gioi'] = $gioi;
           }else{
               $infor = 'X???y ra l???i. Vui l??ng th??? l???i sau';
           }
        }
    }else if(isset($_POST['curPass']) &&  isset($_POST['newPass']) && isset($_POST['newPass_confirm'])){

        $userName = $_SESSION['userName'];
        $curPass = $_POST['curPass'];
        $newPass = $_POST['newPass'];
        $newPass_confirm = $_POST['newPass_confirm'];
        $checkPass = checkPass($userName,$curPass);

        if (empty($curPass)) {
            $error1 = 'Nh???p m???t kh???u hi???n t???i';
        }
        else if (empty($newPass)) {
            $error1 = 'Nh???p m???t kh???u m???i';
        }
        else if (empty($newPass_confirm)) {
            $error1 = 'Nh???p m???t kh???u x??c nh???n';
        }
        else if (strlen($newPass) < 6) {
            $error1 = 'M???t kh???u m???i ph???i nhi???u h??n 6 k?? t???';
        }
        else if ($newPass!= $newPass_confirm) {
            $error1 = 'M???t kh???u kh??ng kh???p';
        }
        else if($checkPass == false){
            $error1 = 'M???t kh???u hi???n t???i kh??ng ????ng';
        }
        else {
            // change password
          $quanly = new NhanVien();
           $result = $quanly->doiMatKhau($userName,$newPass);
           if ($result['code'] == 0){
              $check1 = true;
               $infor = '?????i m???t kh???u th??nh c??ng';
               header('Location: Logout.php');
           }else{
               $infor = 'X???y ra l???i. Vui l??ng th??? l???i sau';
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
            <a href="IndexManager.php" class="navbar-brand"><i class = "management"><img src="Image/management.png"  width="55px" height="55px" style="padding-left: 15px"></i><div class="shop4">Qu???n L??</div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="EditProfile.php"><i class='fas fa-user-edit' style='font-size:35px;color: white;padding-left: 35px'></i><div class="shop3">H??? s?? c?? nh??n</div></a></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php" style="margin-top: 5px;padding-left: 60px; color:white;">????ng xu???t</a>
          </li>
        </ul>
    </nav>
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <form method="post">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thay ?????i th??ng tin c?? nh??n</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">H???</label><input name="ho" type="text" class="form-control" placeholder="" value="<?= $ho?>"></div>
                     <div class="col-md-12"><label class="labels">T??n</label><input name="ten" type="text" class="form-control" placeholder="" value="<?= $ten?>"></div>
                    <div class="col-md-12"><label class="labels">Ng??y sinh</label><input name="birthd" type="date" class="form-control" placeholder="" value="<?= $bdate?>"></div>
                    <div class="col-md-12"><label class="labels">Gi???i t??nh</label>
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
                        >N???
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
                        <div class="mt-2 text-center"><button class="btn btn-success float-right">Thay ?????i th??ng tin</button></div>
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
                    <h4 class="text-right">Thay ?????i m???t kh???u</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">M???t kh???u c??</label><input name="curPass" type="password" class="form-control" placeholder="Nh???p m???t kh???u c??" value="<?= $curPass ?>"></div>
                    <div class="col-md-12"><label class="labels">M???t kh???u m???i</label><input name="newPass"type="password" class="form-control" placeholder="Nh???p m???t kh???u m???i" value="<?= $newPass ?>"></div>
                    <div class="col-md-12"><label class="labels">X??c nh???n MK m???i</label><input name="newPass_confirm" type="password" class="form-control" placeholder="Nh???p m???t kh???u m???i" value="<?= $newPass_confirm?>"></div>
                </div>
                <?php
                            if (!empty($error1)) {
                                echo "<div class='alert alert-danger' style= 'text-align:center;'>$error1</div>";
                            }
                    ?>
                <?php
                    if(!$check1)
                        ?>
                        <div class="mt-4 text-center"><button class="btn btn-success float-right">Thay ?????i m???t kh???u</button></div>
                    <?php
                    if($check1)
                        echo "<div class='alert alert-success' style= 'text-align:center;'>$infor</div>";
                ?>

            </form>
        </div>
        
    </div>
</div>
</body>