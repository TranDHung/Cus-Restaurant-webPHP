<?php
	require_once('Database.php');
	class Phong{
		public $id;
		public $kieuPhong;
		public $gia;
		public $succhua;
		
		function getthongTinPhongById($idRoom){
			$this->id = $idRoom;
			$sql = "select * from phong where id = '$this->id'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			return $data;
		}
		public function getdanhSachPhongTheoSucChua($succhua){
			$this->succhua = $succhua;
			$sql = "select * from phong where succhua >= '$this->succhua'";
			$conn = open_database();
			return $result = $conn->query($sql);
		}
		public function getAllDanhSachPhong(){
			$sql = "select * from phong";
			$conn = open_database();
			return $result = $conn->query($sql);
		}
		public function productPrice($price) {
			$symbol_thousand = '.';
			$decimal_place = 0;
			$price = number_format($price, $decimal_place, '', $symbol_thousand);
			return $price;
		}
	}
	
?>
