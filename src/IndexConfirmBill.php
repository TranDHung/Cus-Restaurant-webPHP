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
	<link rel="stylesheet" href="style.css">
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
 		display: inline-grid;
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
 		height: 36px;
 		color: white;
 		border: 1px solid black;
 		padding-top: 3px;
 		padding-bottom: 2px;
 		background: #8A0808;
 		padding-left: -10px;
 	}
 	.quantity{
 		width: 40px;
 		height: 20px;
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
 		width: 350px; 
 		background-color: red; 
 		z-index: 10; 
 		text-align: center;
 		position: fixed; 
 		border-radius: 20px;
 		left: 0; 
 		top: 0; 
 		height: 200px;
 		margin-top: 60px;
 		margin-left: 30px;
 		opacity: 0.7;
 	}
 	.confirm-payment:hover{
 		opacity: 1;
 	}
 	.total-bill{
 		padding: 20px;
 		color: white;
 	}
 	.price-total-in-cart{
 		color: white;
 		font-size: 35px;
 	}
 	.confirm-btn{
		background: white;
		color: red;
		margin-top: 10px;
		font-weight: bold;
		height: 50px;
		border-radius: 10px;
		border: none;
 	}
 	.line{
    	width: 800px;
    	margin: auto;
    	margin-bottom: 20px;
    	margin-top: 10px;
    }
    .line span{
    	background-color: #F2F2F2;
    	margin: 10px;
    	font-size: 25px;;
    }
    .delete{
    	position: relative;  
    	bottom: 177px; 
    	left: 130px;
    	vertical-align: center;
    	height: 26px;
    }
    
    .fa-close{
    	color: red; 
    	font-size: 20px; 
    }
    
    #sdt::-webkit-outer-spin-button,
    #sdt::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    button:focus {
      outline: none;
    }
    .fa-minus{
    	padding-left: 20px;
    }
	</style>
	<?php
		$tongTien = 0;
		$tenkhach = $_SESSION['tenkhach'];
		$sdt = $_SESSION['sdt'];
		$ngay = $_SESSION['ngay'];
		$gio = $_SESSION['gio'];
		$sokhach = $_SESSION['sokhach'];
		$error = '';
		$danhSachMonAn = [];
		$object = [];
		if(isset($_POST['submit']) && isset($_POST['tenkhach']) && isset($_POST['sdt']) && isset($_POST['ngay']) && isset($_POST['gio']) && isset($_POST['sokhach'])) {

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
	        else if (empty($_SESSION['khaivi'])) {
	            $error1 = 'Chọn món khai vị cho buổi tiệc';
	        }else if (empty($_SESSION['monchinh'])) {
	            $error1 = 'Chọn món chính cho buổi tiệc';
	        }else if (empty($_SESSION['trangmieng'])) {
	            $error1 = 'Chọn món tráng miệng cho buổi tiệc';
	        }else{
	        	for($i = 0; $i<count($_SESSION['khaivi']); $i++){
	        		$danhSachMonAn[$_SESSION['khaivi'][$i]] = $_SESSION['numberkhaivi'][$i];
	        	}
	        	for($i = 0; $i<count($_SESSION['monchinh']); $i++){
	        		$danhSachMonAn[$_SESSION['monchinh'][$i]] = $_SESSION['numbermonchinh'][$i];
	        	}
	        	for($i = 0; $i<count($_SESSION['trangmieng']); $i++){
	        		$danhSachMonAn[$_SESSION['trangmieng'][$i]] = $_SESSION['numbertrangmieng'][$i];
	        	}
	        	$object['ten'] = $tenkhach;
	        	$object['sdt'] = $sdt;
	        	$object['ngay'] = $ngay;
	        	$object['gio'] = $gio;
	        	$object['loaidon'] = $_SESSION['loaidon'];
	        	$object['sokhach'] = $sokhach;
	        	$object['monan'] = $danhSachMonAn;
	        	$object['tongtien'] = $_POST['submit'];
	        	if(isset($_SESSION['phong'])){
	        		$object['phong'] = $_SESSION['phong'];
	        	}else{
	        		$object['phong'] = '';
	        	}

	        	$donDat = new DonDat();
	        	$result = $donDat->addDonDat($object);
	        	if($result['code'] == 1){
	        		$error1 = 'Không thành công! Vui lòng thử lại sau';
	        	}else{
	        		header('Location: Index.php');
	        	}
	        }
	    }

		if(isset($_POST['minusKhaiVi'])){
			if($_SESSION['numberkhaivi'][$_POST['minusKhaiVi']] > 1)
				$_SESSION['numberkhaivi'][$_POST['minusKhaiVi']] = $_SESSION['numberkhaivi'][$_POST['minusKhaiVi']] - 1;
		}
		if(isset($_POST['plusKhaiVi'])){
			$_SESSION['numberkhaivi'][$_POST['plusKhaiVi']] = $_SESSION['numberkhaivi'][$_POST['plusKhaiVi']] + 1;
			//header("Location: indexConfirmBill.php");
		}
		if(isset($_POST['minusMonChinh'])){
			if($_SESSION['numbermonchinh'][$_POST['minusMonChinh']] > 1)
				$_SESSION['numbermonchinh'][$_POST['minusMonChinh']] = $_SESSION['numbermonchinh'][$_POST['minusMonChinh']] - 1;
		}
		if(isset($_POST['plusMonChinh'])){
			$_SESSION['numbermonchinh'][$_POST['plusMonChinh']] = $_SESSION['numbermonchinh'][$_POST['plusMonChinh']] + 1;
		}
		if(isset($_POST['minusTrangMieng'])){
			if($_SESSION['numbertrangmieng'][$_POST['minusTrangMieng']] > 1)
				$_SESSION['numbertrangmieng'][$_POST['minusTrangMieng']] = $_SESSION['numbertrangmieng'][$_POST['minusTrangMieng']] - 1;
		}
		if(isset($_POST['plusTrangMieng'])){
			$_SESSION['numbertrangmieng'][$_POST['plusTrangMieng']] = $_SESSION['numbertrangmieng'][$_POST['plusTrangMieng']] + 1;
		}
		if(isset($_POST['deleteKhaiVi'])){
			array_splice($_SESSION['khaivi'], $_POST['deleteKhaiVi'], 1);
			array_splice($_SESSION['numberkhaivi'], $_POST['deleteKhaiVi'], 1);
		}
		if(isset($_POST['deleteMonChinh'])){
			array_splice($_SESSION['monchinh'], $_POST['deleteMonChinh'], 1);
			array_splice($_SESSION['numbermonchinh'], $_POST['deleteMonChinh'], 1);
		}
		if(isset($_POST['deleteTrangMieng'])){
			array_splice($_SESSION['trangmieng'], $_POST['deleteTrangMieng'], 1);
			array_splice($_SESSION['numbertrangmieng'], $_POST['deleteTrangMieng'], 1);
		}
	?>
	<script type="text/javascript">
		
	</script>
</head>
<body>
	<form method="post" name="" id="dattiec">
	<div class="customer-info">
		<div class="title-cart" style="margin-top: 20px;">
			<img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-custom-info.png">
		</div><hr class="short-line">
		<div class="field">
			<span>Họ và Tên:</span>
			<input class="form-control" type="text" value="<?=$tenkhach?>" name="tenkhach">
		</div>
		<div class="field">
			<span>Số điện thoại:</span>
			<input class="form-control" type="number" value="<?= $sdt?>" id="sdt" name="sdt">
		</div>
		<div class="field">
			<span>Ngày đặt:</span>
			<input class="form-control" type="date" value="<?= $ngay?>" name="ngay">
		</div>
		<div class="field">
			<span>Giờ đặt:</span>
			<input class="form-control" type="time" value="<?= $gio?>" name="gio">
		</div>
		<div class="field">
			<span>Số lượng khách:</span>
			<input class="form-control" type="text" value="<?= $sokhach?>" name="sokhach" readonly>
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
			<img src="Image/dishes.png">
		</div><hr class="short-line">
		<div class="div-khaivi">
			<h2 class="line" style="padding-top: 10px;"><span style="color: red;">Khai vị</span></h2>
			<?php
				for($i = 0; $i<count($_SESSION['numberkhaivi']);$i++) {
					$soluong = $_SESSION['numberkhaivi'][$i];
					$monAn = new MonAn();
					$result = $monAn->getThongTinMonAnById($_SESSION['khaivi'][$i]);
					$tongTien = $tongTien + ($soluong*$result['gia']);
			?>
			<form name= "" id="" method="post">
			<div class="food">
				<img class="food-img" src="Image/khaivi/<?= $result['anh']?>">
				<div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
				<div class="food-name"><span><?= $result['ten']?></span></div>
				<div class="soluong">
					<span>Số lượng</span>
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="minusKhaiVi" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
					<input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="plusKhaiVi" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
				</div>
				<button class="delete" style="background-color: white;margin: 4px;" name="deleteKhaiVi" value="<?= $i ?>" type = "submit"><i class="fa fa-close"></i></button>
			</div>
			</form>
			<?php
				}
			?>
		</div>
		<div class="div-chinh">
			<h2 class="line" style="padding-top: 10px;"><span style="color: red;">Món chính</span></h2>
			<?php
				for($i = 0; $i<count($_SESSION['numbermonchinh']);$i++) {
					$soluong = $_SESSION['numbermonchinh'][$i];
					$monAn = new MonAn();
					$result = $monAn->getThongTinMonAnById($_SESSION['monchinh'][$i]);
					$tongTien = $tongTien + ($soluong*$result['gia']);
			?>
			<form method="post">
			<div class="food">
				<img class="food-img" src="Image/monchinh/<?= $result['anh']?>">
				<div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
				<div class="food-name"><span><?= $result['ten']?></span></div>
				<div class="soluong">
					<span>Số lượng</span>
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="minusMonChinh" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
					<input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="plusMonChinh" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
				</div>
				<button class="delete" style="background-color: white;margin: 4px;" name="deleteMonChinh" value="<?= $i ?>" type = "submit"><i class="fa fa-close"></i></button>
			</div>
			</form>
			<?php
				}
			?>
		</div>
		<div class="div-trangmieng">
			<h2 class="line" style="padding-top: 10px;"><span style="color: red;">Tráng miệng</span></h2>
			<?php
				for($i = 0; $i<count($_SESSION['numbertrangmieng']);$i++) {
					$soluong = $_SESSION['numbertrangmieng'][$i];
					$monAn = new MonAn();
					$result = $monAn->getThongTinMonAnById($_SESSION['trangmieng'][$i]);
					$tongTien = $tongTien + ($soluong*$result['gia']);
			?>
			<form method="post">
			<div class="food">
				<img class="food-img" src="Image/trangmieng/<?= $result['anh']?>">
				<div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
				<div class="food-name"><span><?= $result['ten']?></span></div>
				<div class="soluong">
					<span>Số lượng</span>
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="minusTrangMieng" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
					<input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
					<button class="changeNumber" style="border: none; background-color:#8A0808;" name="plusTrangMieng" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
				</div>
				<button class="delete" style="background-color: white;margin: 4px;" name="deleteTrangMieng" value="<?= $i ?>" type = "submit"><i class="fa fa-close"></i></button>
			</div>
			</form>
			<?php
				}
			?>
		</div>
	</div>
	<?php
		 if (isset($_SESSION['phong'])){
			$room = new Phong();
			$result = $room->getthongTinPhongById($_SESSION['phong']);
			$tongTien = $tongTien + $result['gia'];
			if($result['kieuphong'] == 1){
                  $ten = 'PHÒNG VIP';
                }else{
                  $ten = 'PHÒNG THƯỜNG';
             }
		?>
	<hr>
	<div class="room-list">
		<div class="title-cart">
			<img src="Image/room.png">
		</div><hr class="short-line">
		<div class="room" style="margin-left: 485px;">
			<img class="room-img" src="Image/phong/<?= $result['anh']?>">
			<div class="text-cost"><?= $room->productPrice($result['gia'])?> đ</div>
			<div class="food-name"><span><?= $ten?></span></div>
		</div>
	</div>
	<?php
	}
	?>
	</form>
	<hr>
	<div class="confirm-payment">
		<div class="div-of-total">
			<div class="total-bill">
				Tổng số tiền: 
			</div>
			<div class="price-total-in-cart"><?= $monAn->productPrice($tongTien)?> đ</div>
			<button class="confirm-btn" type="submit" form="dattiec" name="submit"
			<?php
			if($_SESSION['loaidon'] == 1){
				?>
				onclick="return alert('Đặt tiệc thành công!')"
			<?php
		}else{
			?>
			onclick="return alert('Đặt bàn thành công!')"
			<?php
		}
		?>
				 value="<?= $tongTien ?>">XÁC NHẬN ĐƠN ĐẶT</button>
		</div>
	</div>
</body>
</html>