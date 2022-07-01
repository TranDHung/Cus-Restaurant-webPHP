<?php
    session_start();
    require_once('RoomDB.php');
    require_once('MenuDB.php');
    require_once('TheOrderDB.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
	body {
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
 		display: table-cell;
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
 		color: white;
 		border: 1px solid black;
 		padding-top: 3px;
 		padding-bottom: 2px;
 		background: #8A0808;
 	}
 	#quantity{
 		width: 70px;
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
 		margin-left: 60px;
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
 	.total-bill{
 		padding: 20px;
 		color: white;
 	}
 	.price-total-in-cart{
 		color: white;
 		font-size: 35px;
 	}
 	.confirm-payment{
 		text-align: center;
 	}
 	.confirm-btn{
		background: brown;
		color: gold;
		margin-top: 10px;
		margin-bottom: 10px;
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
	<?php
		$error = '';
		if(isset($_POST['submit'])){
			if(empty($_POST['phong'])){
				$error = 'Vui lòng chọn phòng cho buổi tiệc';
			}else{
				$_SESSION['phong'] = $_POST['phong'];
				if(!isset($_SESSION['update']) && !isset($_SESSION['chonPhong'])){
					header('Location: IndexConfirmBill.php');
				}else{
					if(!isset($_SESSION['chonPhong'])){
						$donDat = new DonDat();
						$donDat->updatePhong($_SESSION['id'],$_SESSION['phong']);
						header('Location: EditOrder.php');
					}else{
						$_SESSION['chonPhong'] = $_POST['phong'];
						header('Location: AddBill.php');
					}
				}
			}
		}
	?>
</head>
<script>
	function showContact(){
    document.getElementById("contactInfo").style.display = "block";
    }
    function hideContact(){
      document.getElementById("contactInfo").style.display = "none";
    }
</script>
<nav class="navbar navbar-expand-sm" style="background-color: #B40404;">
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="70px"></a>
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
<body>
<hr class="short-line">
  <div class="room-list">
    <div class="title-cart">
      <img src="https://vietpho.com.vn/public/app/new/booking/vp_files/select-room.png">
    </div><?php
    if(isset($_SESSION['update'])){
    	?>
    	<span><a<?php if(isset($_SESSION['createBill'])){
			?>
			href="AddBill.php"
			<?php
		}else{
			?>
			href="EditOrder.php"
			<?php
		}
		?>
		 style="padding-left: 15px;font-size: 20px; float: left;">Quay lại</a></span>
    	<?php
    }
    ?>
    <hr class="short-line">
    <form method="post" id="formRoom">
    <?php
    	if(!isset($_SESSION['createBill'])){
	    	$loaiDon = $_SESSION['loaidon'];
		    if($loaiDon != 2){
		      $room = new Phong();
		      $result = $room-> getdanhSachPhongTheoSucChua($_SESSION['sokhach']);
		      if ($result->num_rows > 0) {
		              while($row = $result->fetch_assoc()) {
		                $price = $room->productPrice($row['gia']);
		                if($row['kieuphong'] == 1){
		                  $ten = 'PHÒNG VIP';
		                }else{
		                  $ten = 'PHÒNG THƯỜNG';
		                }
		                $path = 'Image/phong/';
    ?>
    <label>
    <div class="room">
      <img class="room-img" src="<?=$path.''.$row['anh']?>">
      <div class="text-cost"><?=$price?> đ</div>
      <div class="food-name"><span style=""><?=$ten?></span><span><input style="float: right; margin-top: 9px; margin-right: 8px; transform: scale(1.5);filter: hue-rotate(-0.25turn);" type="radio" name="phong" value="<?=$row['id']?>"></span></div>
    </div>
    </label>
    <?php
      	}
      }
	}
	else{
		$room = new Phong();
	    $result = $room-> getAllDanhSachPhong();
	    if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	            $price = $room->productPrice($row['gia']);
	            if($row['succhua'] <= 20){
	                if($row['kieuphong'] == 1){
	                  $ten = 'PHÒNG VIP';
	                }else{
	                  $ten = 'PHÒNG THƯỜNG';
	                }
	                $path = 'Image/phong/';
    ?>
    <label>
    <div class="room">
      <img class="room-img" src="<?=$path.''.$row['anh']?>">
      <div class="text-cost"><?=$price?> đ</div>
      <div class="food-name"><span style=""><?=$ten?></span><span><input style="float: right; margin-top: 9px; margin-right: 8px; transform: scale(1.5);filter: hue-rotate(-0.25turn);" type="radio" name="phong" value="<?=$row['id']?>"></span></div>
    </div>
    </label>
    <?php
      }
  	}
    }
	}
	}else{
		$room = new Phong();
	    $result = $room-> getAllDanhSachPhong();
	    if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	            $price = $room->productPrice($row['gia']);
                if($row['kieuphong'] == 1){
                  $ten = 'PHÒNG VIP';
                }else{
                  $ten = 'PHÒNG THƯỜNG';
                }
                $path = 'Image/phong/';
    ?>
    <label>
    <div class="room">
      <img class="room-img" src="<?=$path.''.$row['anh']?>">
      <div class="text-cost"><?=$price?> đ</div>
      <div class="food-name"><span style=""><?=$ten?></span><span><input style="float: right; margin-top: 9px; margin-right: 8px; transform: scale(1.5);filter: hue-rotate(-0.25turn);" type="radio" name="phong" value="<?=$row['id']?>"></span></div>
    </div>
    </label>
    <?php
      }
  	}
	}
  ?>
</form>
  </div>
	<hr>
	<?php
	if (!empty($error)) {
        echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px;text-align:center;margin-left:460px;'>$error</div>";
    }
	?>
	<div class="confirm-payment">
		<div class="div-of-total">
			<button class="confirm-btn" type="submit" form="formRoom" name="submit">XÁC NHẬN</button>
		</div>
	</div>
</body>
</html>