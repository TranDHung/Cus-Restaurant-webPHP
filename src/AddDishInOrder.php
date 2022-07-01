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
	</style>
	<?php
		$danhSachMon = [];
		$_SESSION['dsCu'] = $_SESSION['monAn'];
		$monAn = $_SESSION['monAn'];
		$danhSach = explode(',',$monAn);
	    $danhSachMonAn = [];
	    $danhSachSoLuong = [];
	    foreach ($danhSach as $mon) {
	      $monVaSoLuong = explode(':',$mon);
	      if(!empty($monVaSoLuong[1])){
	        array_push($danhSachMonAn, $monVaSoLuong[0]);
	        array_push($danhSachSoLuong, $monVaSoLuong[1]);
	      }
	    }
	    for($i = 0; $i<count($danhSachMonAn); $i++){
	    	$danhSachMon[$danhSachMonAn[$i]] = $danhSachSoLuong[$i];
	    }
	    if(isset($_SESSION['createBill'])){
	    	$_SESSION['monAn'] = $danhSachMon;
		}
	    if(isset($_POST['submit'])){
	    	if (!empty($_POST['listKhaiVi'])) {
	        	$soMonKhaiVi = [];
				foreach($_POST['numberlistKhaiVi'] as $selected){
					if($selected > 0)
						array_push($soMonKhaiVi,$selected);
				}
				$monKhaiVi = $_POST['listKhaiVi'];
				for($i = 0; $i<count($monKhaiVi); $i++){
	    			$danhSachMon[$monKhaiVi[$i]] = $soMonKhaiVi[$i];
	    		}
			}
			if(!empty($_POST['listMonChinh'])){
				$soMonChinh = [];
				foreach($_POST['numberlistMonChinh'] as $selected){
					if($selected > 0)
						array_push($soMonChinh,$selected);
				}
				$monChinh = $_POST['listMonChinh'];
				for($i = 0; $i<count($monChinh); $i++){
		    		$danhSachMon[$monChinh[$i]] = $soMonChinh[$i];
		    	}
			}
			if(!empty($_POST['listTrangMieng'])){
				$soMonTrangMieng = [];
				foreach($_POST['numberlistTrangMieng'] as $selected){
					if($selected > 0)
						array_push($soMonTrangMieng,$selected);
				}
				$monTrangMieng = $_POST['listTrangMieng'];
				for($i = 0; $i<count($monTrangMieng); $i++){
		    		$danhSachMon[$monTrangMieng[$i]] = $soMonTrangMieng[$i];
		    	}
			}
			$monAn='';
			if(!isset($_SESSION['createBill'])){
		    	foreach ($danhSachMon as $key => $value) {
			     	$string = $key.':'.$value;
			    	$monAn .= $string.',';
			    }
			    $donDat = new DonDat();
				$donDat->updateMon($_SESSION['id'],$monAn);
			    header('Location: EditOrder.php');
			}else{
				$_SESSION['monAn'] = array_merge($_SESSION['dsCu'],$danhSachMon);
				header('Location: AddBill.php');
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
</script>

<body>
	<form action="" method="post" id="formfood">
	<div class="food-list">
		<div class="title-cart">
			<img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-choose-dishes.png">
		</div><span><a <?php if(isset($_SESSION['createBill'])){
			?>
			href="AddBill.php"
			<?php
		}else{
			?>
			href="EditOrder.php"
			<?php
		}
		?>
		style="padding-left: 15px;font-size: 20px; float: left;">Quay lại</a></span><hr class="short-line">
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
            		if(in_array($row['id'], $danhSachMonAn)){}
            		else{
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
		}
		?>
		</div>
		<div id="danhsach2" style="display: none">
		<?php
			$monan = new MonAn();
			$result = $monan->getDanhSachMonAnByVitri(2);
			if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
            		if(in_array($row['id'], $danhSachMonAn)){}
            		else{
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
		}
		?>
		</div>
		<div id="danhsach3" style="display: none">
		<?php
			$monan = new MonAn();
			$result = $monan->getDanhSachMonAnByVitri(3);
			if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
            		if(in_array($row['id'], $danhSachMonAn)){}
            		else{
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
		}
		?>
	</div>
	</div>
</form>
<hr>
<div class="confirm-payment">
		<div class="div-of-total">
			<button class="confirm-btn" type="submit" form="formfood" name="submit">XÁC NHẬN</button>
		</div>
	</div>
</body>
</html>