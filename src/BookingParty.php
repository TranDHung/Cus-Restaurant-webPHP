<?php
    session_start();
    require_once('RoomDB.php');
    require_once('MenuDB.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
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
 		display: inline-table;
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
 		padding-left: -10px;
 	}
 	.quantity{
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
		width: 369px;
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
 	#sokhach::-webkit-outer-spin-button,
    #sokhach::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    #sdt::-webkit-outer-spin-button,
    #sdt::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .line{
    	width: 800px;
    	margin: auto;
    	margin-bottom: 20px;
    }
    .line span{
    	background-color: #F2F2F2;
    	margin: 10px;
    	font-size: 25px;;
    }
    .div-of-btn{
    	text-align: center;
    }
    .div-of-btn button{
    	width: 200px;
    	height: 50px;
    	font-size: 25px;
    	border: none;
    	margin: 10px;
    }
    .btn-hide:focus{
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
	<?php
		$tenkhach = '';
		$sdt = '';
		$ngay = '';
		$gio = '';
		$sokhach = '';
		$error1 = '';

		if(isset($_POST['tenkhach']) && isset($_POST['sdt']) && isset($_POST['ngay']) && isset($_POST['gio']) && isset($_POST['sokhach'])) {

	        $tenkhach =$_POST['tenkhach'];
	        $sdt = $_POST['sdt'];
	      	$ngay = $_POST['ngay'];
	        $gio = $_POST['gio'];
	        $sokhach = $_POST['sokhach'];

	        if (empty($tenkhach)) {
	            $error1 = 'Vui lòng nhập tên của bạn!';
	        }
	        else if (empty($sdt)) {
	            $error1 = 'Nhập số điện thoại';
	        }
	        else if (empty($ngay)) {
	            $error1 = 'Chọn ngày đặt';
	        }
	        else if (empty($gio)) {
	            $error1 = 'Nhập giờ của buổi tiệc';
	        }
	        else if (empty($sokhach)) {
	            $error1 = 'Nhập số khách của buổi tiệc';
	        }
	        else if (empty($_POST['listKhaiVi'])) {
	            $error1 = 'Chọn món khai vị cho buổi tiệc';
	        }else if (empty($_POST['listMonChinh'])) {
	            $error1 = 'Chọn món chính cho buổi tiệc';
	        }else if (empty($_POST['listTrangMieng'])) {
	            $error1 = 'Chọn món tráng miệng cho buổi tiệc';
	        }else{
	        	$soMonKhaiVi = [];
				foreach($_POST['numberlistKhaiVi'] as $selected){
					if($selected > 0)
						array_push($soMonKhaiVi,$selected);
				}
				$soMonChinh = [];
				foreach($_POST['numberlistMonChinh'] as $selected){
					if($selected > 0)
						array_push($soMonChinh,$selected);
				}
				$soMonTrangMieng = [];
				foreach($_POST['numberlistTrangMieng'] as $selected){
					if($selected > 0)
						array_push($soMonTrangMieng,$selected);
				}

	        	$_SESSION['tenkhach'] = $tenkhach;
	        	$_SESSION['sdt'] = $sdt;
	        	$_SESSION['ngay'] = $ngay;
	        	$_SESSION['gio'] = $gio;
	        	$_SESSION['sokhach'] = $sokhach;
	        	$_SESSION['numberkhaivi'] = $soMonKhaiVi;
	        	$_SESSION['numbermonchinh'] = $soMonChinh;
	        	$_SESSION['numbertrangmieng'] = $soMonTrangMieng;
	        	$_SESSION['khaivi'] = $_POST['listKhaiVi'];
	        	$_SESSION['monchinh'] = $_POST['listMonChinh'];
	        	$_SESSION['trangmieng'] = $_POST['listTrangMieng'];
	        	$_SESSION['loaidon'] = 1;
	        	header('Location: ChooseRoom.php');
	        }
	    }
	?>
</head>
<script type="text/javascript">
	function showKhaiVi(){
		var khaiVi = document.getElementById("danhsach1");
		var monChinh = document.getElementById("danhsach2");
		var trangMieng = document.getElementById("danhsach3");
		document.getElementById("tenDanhSach").innerHTML = "Khai vị";
		khaiVi.style.display = "block";
		monChinh.style.display = "none";
		trangMieng.style.display = "none";
	}
	function showMonChinh(){
		var khaiVi = document.getElementById("danhsach1");
		var monChinh = document.getElementById("danhsach2");
		var trangMieng = document.getElementById("danhsach3");
		document.getElementById("tenDanhSach").innerHTML = "Món chính";
		khaiVi.style.display = "none";
		monChinh.style.display = "block";
		trangMieng.style.display = "none";
	}
	function showTrangMieng(){
		var khaiVi = document.getElementById("danhsach1");
		var monChinh = document.getElementById("danhsach2");
		var trangMieng = document.getElementById("danhsach3");
		document.getElementById("tenDanhSach").innerHTML = "Tráng miệng";
		khaiVi.style.display = "none";
		monChinh.style.display = "none";
		trangMieng.style.display = "block";
	}
	function soLuong(element){
		var numb  = element.value;
		if(numb > 0){
			$(element).next( ".check" ).prop( "disabled",false);
			$(element).next( ".check" ).prop("checked", true);
		}else{
			$(element).next( ".check" ).prop("checked", false);
			$(element).next( ".check" ).prop( "disabled",true);
		}
	}
	function checkCheckBox(element){
		if(element.checked == false){
			$(element).prev(".quantity").val(0);
			element.disabled = true;
		}
	}
	function showContact(){
    document.getElementById("contactInfo").style.display = "block";
    }
    function hideContact(){
      document.getElementById("contactInfo").style.display = "none";
    }
</script>
<nav class="navbar navbar-expand-sm" style="background-color: #B40404;">
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="10px"></a>
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
	<form action="" method="post" id="formfood">
	<div class="customer-info">
		<div class="title-cart" style="margin-top: 20px;">
			<img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-custom-info.png">
		</div><hr class="short-line">
		<div class="field">
			<span>Họ và Tên:</span>
			<input class="form-control" type="text" name="tenkhach" value="<?=$tenkhach?>">
		</div>
		<div class="field">
			<span>Số điện thoại:</span>
			<input class="form-control" type="number" name="sdt" id="sdt" value="<?=$sdt?>">
		</div>
		<div class="field">
			<span>Ngày đặt:</span>
			<input class="form-control" type="date" name="ngay" value="<?=$ngay?>">
		</div>
		<div class="field">
			<span>Giờ đặt:</span>
			<input class="form-control" type="time" name="gio" value="<?=$gio?>">
		</div>
		<div class="field">
			<span>Số lượng khách:</span>
			<input class="form-control" type="number" name="sokhach" id="sokhach" value="<?=$sokhach?>">
		</div>
		 <?php
        if (!empty($error1)) {
            echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px;text-align:center;margin-left:775px;'>$error1</div>";
	        }
	    ?>
	</div>
	<hr>
	<div class="food-list">
		<div class="title-cart">
			<img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-choose-dishes.png">
		</div><hr class="short-line">
		<div class="div-of-btn">
			<button class="btn-hide" style="color: white; background-color: darkgreen" type="button" onclick="showKhaiVi()">Khai vị</button>
			<button class="btn-hide" style="color: white; background-color: darkgreen" type="button" onclick="showMonChinh()">Món chính</button>
			<button class="btn-hide" style="color: white; background-color: darkgreen" type="button" onclick="showTrangMieng()">Tráng miệng</button>
		</div>
		<h2 class="line" style="padding-top: 10px;"><span id="tenDanhSach" style="color: red;">Khai vị</span></h2>
		<div id="danhsach1">
		<?php
			$monan = new MonAn();
			$result = $monan->getDanhSachMonAnByVitri(1);
			if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
            		$price = $monan-> productPrice($row['gia']);
		?>
		<div class="food">
			<img class="food-img" src="Image/khaivi/<?=$row['anh']?>">
			<div class="text-cost"><?= $price?> đ</div>
			<div class="food-name"><span><?=$row['ten']?></span></div>
			<div class="soluong">
				<span>Số lượng</span>
				<input class="quantity" type="number" value="0" name="numberlistKhaiVi[]" min="0" max="100" onchange="soLuong(this)" id="count">
				<input style="margin-left: 50px;" type="checkbox" disabled="true" class="check" name="listKhaiVi[]" value="<?= $row['id']?>" onclick="checkCheckBox(this)"> Chọn
			</div>
		</div>
		<?php
			}
		}
		?>
		</div>
		<div id="danhsach2" style="display: none">
		<?php
			$monan = new MonAn();
			$result = $monan->getDanhSachMonAnByVitri(2);
			if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
            		$price = $monan-> productPrice($row['gia']);
		?>
		<div class="food">
			<img class="food-img" src="Image/monchinh/<?=$row['anh']?>">
			<div class="text-cost"><?= $price?> đ</div>
			<div class="food-name"><span><?=$row['ten']?></span></div>
			<div class="soluong">
				<span>Số lượng</span>
				<input class="quantity" type="number" value="0" name="numberlistMonChinh[]" min="0" max="100" onchange="soLuong(this)" id="count">
				<input style="margin-left: 50px;" type="checkbox" disabled="true" class="check" name="listMonChinh[]" value="<?= $row['id']?>" onclick="checkCheckBox(this)"> Chọn
			</div>
		</div>
		<?php
			}
		}
		?>
		</div>
		<div id="danhsach3" style="display: none">
		<?php
			$monan = new MonAn();
			$result = $monan->getDanhSachMonAnByVitri(3);
			if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
            		$price = $monan-> productPrice($row['gia']);
		?>
		<div class="food">
			<img class="food-img" src="Image/trangmieng/<?=$row['anh']?>">
			<div class="text-cost"><?= $price?> đ</div>
			<div class="food-name"><span><?=$row['ten']?></span></div>
			<div class="soluong">
				<span>Số lượng</span>
				<input class="quantity" type="number" value="0" name="numberlistTrangMieng[]" min="0" max="100" onchange="soLuong(this)" id="count">
				<input style="margin-left: 50px;" type="checkbox" disabled="true" class="check" name="listTrangMieng[]" value="<?= $row['id']?>" onclick="checkCheckBox(this)"> Chọn
			</div>
		</div>
		<?php
			}
		}
		?>
	</div>
	</div>
	</form>
	<hr>
	<div class="confirm-payment">
		<div class="div-of-total">
			<button class="confirm-btn" type="submit" form="formfood" name="submit">TIẾP TỤC</button>
		</div>
	</div>
</body>
</html>