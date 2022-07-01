<?php
	define('HOST','127.0.0.1');
	define('USER','root');
	define('PASS','');
	define('DB','quanlynhahang');
	
	function open_database(){
		$conn = new mysqli(HOST,USER,PASS,DB);
		if ($conn ->connect_error){
			die('Connect error: '.$conn->connect_error);
		}
		return $conn;
		
	}
	function isUsernameExists($user){
		$sql = "select * from account where userName = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$user);
		
		if (!$stm ->execute()){
			die('Query error: '.$stm->error);
		}
		
		$result = $stm->get_result();
		if($result->num_rows >0){
			return true;
		}
	}
	function getUserName($id){
		$sql = "select * from account where id = '$id'";
		$conn = open_database();
		$result = $conn->query($sql);
		$data = $result->fetch_assoc();
		return $data;

	}
	function isTenDishExists($id){
		$sql = "select * from monan where ten = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$id);
		
		if (!$stm ->execute()){
			die('Query error: '.$stm->error);
		}
		
		$result = $stm->get_result();
		if($result->num_rows >0){
			return true;
		}
	}
	function isIDPhongExists($id){
		$sql = "select * from phong where id = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$id);
		
		if (!$stm ->execute()){
			die('Query error: '.$stm->error);
		}
		
		$result = $stm->get_result();
		if($result->num_rows >0){
			return true;
		}
	}
	function checkPass($user,$curPass){
		$sql = "select * from account where userName = ?";
		$conn = open_database();
		
		$stm = $conn->prepare($sql);
		$stm -> bind_param('s',$user);
		if (!$stm -> execute()){
			return false;
		}
		$result = $stm->get_result();
		
		$data = $result->fetch_assoc();
		
		$hashed_password = $data['password'];
		if(!password_verify($curPass, $hashed_password)){
			return false;
		}else
			return true;
	}
	function getTongSoMonAn(){
		$conn = open_database();
		$sql = "select * from monan";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
	function getTongSoPhong(){
		$conn = open_database();
		$sql = "select * from phong";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
	function getTongSoNhanVien(){
		$conn = open_database();
		$sql = "select * from account";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
	function getTongSoDonDat(){
		$conn = open_database();
		$sql = "select * from dondat";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
	function getTongSoHoaDon(){
		$conn = open_database();
		$sql = "select * from hoadon";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
	function getTongSoDonDatChoThanhToan(){
		$conn = open_database();
		$sql = "select * from dondat where trangthai = 0";
		$result=mysqli_query($conn,$sql);
		$rowcount=mysqli_num_rows($result);
		return $rowcount;
	}
?>