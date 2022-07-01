<?php
	session_start();
	require('MenuDB.php');
	$mon = new MonAn();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background-image: url("Image/backgroundMenu.jpg");
		}
		.title-menu{
			font-family: Brush Script MT, Brush Script Std, cursive;
			font-size: 100px;
			color: white;
			text-align: center;
		}
		.row-food{
			overflow: auto;
		}
		.food{
			float: left;
			margin: 5px;
		}
		.food img{
			width: 320px;
			height: 220px;
		}
		.food-name{
			color: white;
			font-family: Comic Sans MS, Comic Sans, cursive;
			text-align: center;
			font-size: 25px;
		}
		.set{
			font-size: 50px;
			color: white;
			font-style: italic;
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
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="10px"></a>
    <form method="post" id="timkiem"><input class="searchbar" type="text" name="noidung" placeholder="Tìm kiếm món ăn"><button type="submit" style="border: none; border-top-right-radius: 3px; border-bottom-right-radius: 3px; height: 40px; width: 100px;" name="timkiem" form="timkiem" value="<?=$timKiem?>">Tìm kiếm</button></form>
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
  }
}
}else{
  ?>
<body>
<div class="title-menu">Menu</div>
<div class="set">Khai vị</div>
<div class="row-food">
	<?php
		$result = $mon->getDanhSachMonAnByVitri(1);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
	?>
	<div class="food">
		<img src="Image/khaivi/<?= $row['anh']?>">
		<div class="food-name"><?= $row['ten']?></div>
	</div>
	<?php
		}
	}
	?>
</div>
<div class="set">Món chính</div>
<div class="row-food">
	<?php
		$result = $mon->getDanhSachMonAnByVitri(2);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
	?>
	<div class="food">
		<img src="Image/monchinh/<?= $row['anh']?>">
		<div class="food-name"><?= $row['ten']?></div>
	</div>
	<?php
		}
	}
	?>
</div>
<div class="set">Tráng miệng</div>
<div class="row-food">
	<?php
		$result = $mon->getDanhSachMonAnByVitri(3);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
	?>
	<div class="food">
		<img src="Image/trangmieng/<?= $row['anh']?>">
		<div class="food-name"><?= $row['ten']?></div>
	</div>
	<?php
		}
	}
	?>
</div>
</body>
<?php
}
?>
</html>