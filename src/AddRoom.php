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
      width: 470px;
      height: 470px;
      background: white;
      border-radius: 25px;
      padding-left: 20px;
      padding-top: 20px;
      margin: auto;
      margin-top: 30px;
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
    #gia::-webkit-outer-spin-button,
    #gia::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    #chua::-webkit-outer-spin-button,
    #chua::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
  </style>

   <?php
    $id ='';
    $loai = '';
    $gia = '';
    $anh = '';
    $error1 = '';
    $infor = '';
    $succhua = '';
    $object = [];
    if(isset($_POST['submit']) && isset($_POST['id']) && isset($_POST['loai']) && isset($_POST['gia'])  && isset($_POST['chua'])) {

        $id =$_POST['id'];
        $loai = $_POST['loai'];
        $gia = $_POST['gia'];
        $anh = $_POST['anh'];
        $succhua = $_POST['chua'];

        if (empty($id)) {
            $error1 = 'Nhập ID phòng';
        }
        else if (empty($loai)) {
            $error1 = 'Nhập loại phòng';
        }
        else if (empty($gia)) {
            $error1 = 'Nhập giá phòng';
        }
        else if (empty($succhua)) {
            $error1 = 'Nhập số lượng người';
        }
        else {
            $quanly = new QuanLy();
            $object['id'] = $id;
            $object['loai'] = $loai;
            $object['gia'] = $gia;
            $object['anh'] = $anh;
            $object['succhua'] = $succhua;
            $result = $quanly->themPhong($object);
           if ($result['code'] == 0){
               $infor = 'Thêm thông tin thành công';
               header('Location: indexMaRoom.php');
           }else{
              $error1 = 'ID phòng đã tồn tại';
           }
        }
    }
    if(isset($_POST['reset'])){
      header("Location: AddRoom.php");
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
    <div class="text-create">Thêm phòng</div>
    <div class="field" style="margin-top: 30px;">
      <span>ID: </span>
      <input type="text" name="id" class="form-control" value="<?=$id ?>" autofocus>
    </div>
    <div class="field">
      <span>Loại phòng: </span>
      <input type="number" name="loai" class="form-control" value="<?=$loai ?>" min="1" max="2"  placeholder="1.Phòng VIP - 2.Phòng thường">
    </div>
    <div class="field">
      <span>Giá: </span>
      <input type="number" name="gia" class="form-control" value="<?=$gia ?>" id="gia">
    </div>
    <div class="field" style="padding-bottom: 10px;margin-bottom: 20px">
      <span>Hình ảnh: </span>
      <input class = "file" type="file" name="anh" class="select-file" value="<?=$anh ?>" style="padding-left: 25px;" accept=".png,.jpg,.gif">
    </div>
    <div class="field">
      <span>Sức chứa: </span>
      <input type="number" name="chua" class="form-control" value="<?=$succhua ?>" id="chua">
    </div>
    <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px'>$error1</div>";
        }
    ?>
    <div style="padding-top: 10px;">
    <a href="IndexMaRoom.php" style="float: left; padding-top: 5px;">Quay lại</a>
    <button class="create-btn" type="submit" name="submit">Thêm phòng</button>
    <button class="return-btn" name="reset">Reset</button>
    <div>
  </form>
</body>
</html>