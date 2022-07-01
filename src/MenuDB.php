<?php
	require_once('Database.php');
	class MonAn{
		public $id;
		public $tenMonAn;
		public $gia;
		public $anh;
		public $viTri;
		public function getThongTinMonAnById($id){
			$this->id = $id;
			$sql = "select * from monan where id = '$this->id'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			return $data;
		}
		public function getThongTinTimKiem($infor){
			if(!is_numeric($infor)){
				$sql = "select * from monan where ten like '%".$infor."%'";
				$conn = open_database();
				return $result = $conn->query($sql);
			}else{
				$sql = "select * from dondat where sdt like '%".$infor."%'";
				$conn = open_database();
				return $result = $conn->query($sql);
			}
		}
		public function getDanhSachMonAnByVitri($viTri){
			$this->viTri = $viTri;
			$sql = "select * from monan where vitri = '$this->viTri'";
			$conn = open_database();
			return $result = $conn->query($sql);
		}
		public function getAllDanhSachMonAn(){
			$sql = "select * from monan";
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