<?php
	require_once('Database.php');
	class DonDat{
		public $id;
		public $tenKhach;
		public $sdt;
		public $loaiDon;
		public $phong;
		public $ngayDat;
		public $soLuongKhach;
		public $gioDat;
		public $monAn = '';
		public $tongTien;
		public $trangThai;

		function taoIDDonDat($loaiDon){
			$sql = "select count(*) as total from dondat where loaidon = '$loaiDon'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			$count = $data['total'];
			$id = '';
			if($loaiDon == 1){
				if($count < 10){
		        	$id = 'DT0000000'.($count+1);
		        }else if($count < 100){
		        	$id = 'DT000000'.($count+1);
		        }else if($count < 1000){
		        	$id = 'DT00000'.($count+1);
		        }
		        else if($count < 10000){
		        	$id = 'DT0000'.($count+1);
		        }
			}else{
				if($count < 10){
		        	$id = 'DB0000000'.($count+1);
		        }else if($count < 100){
		        	$id = 'DB000000'.($count+1);
		        }else if($count < 1000){
		        	$id = 'DB00000'.($count+1);
		        }
		        else if($count < 10000){
		        	$id = 'DB0000'.($count+1);
		        }
			}
	        return $id;
	    }
	    function addDonDat($object){
	    	$this->id = $this->taoIDDonDat($object['loaidon']);
	    	$this->tenKhach = $object['ten'];
	    	$this->sdt = $object['sdt'];
	    	$this->ngayDat = $object['ngay'];
	    	$this->gioDat = $object['gio'];
	    	$this->loaiDon = $object['loaidon'];
	    	$monAn='';
	    	foreach ($object['monan'] as $key => $value) {
		     	$string = $key.':'.$value;
		    	$monAn .= $string.',';
		    }
	    	$this->monAn = $monAn;
	    	$this->soLuongKhach = $object['sokhach'];
	    	$this->phong = $object['phong'];
	    	$this->tongTien = $object['tongtien'];
	    	$sql = "insert into dondat(id,tenkhach,sdt,loaidon,phong,ngaydat,giodat,slkhach,monan,tongtien) value(?,?,?,?,?,?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			$stm->bind_param('sssisssisi', $this->id,$this->tenKhach,$this->sdt,$this->loaiDon,$this->phong,$this->ngayDat,$this->gioDat,$this->soLuongKhach,$this->monAn,$this->tongTien);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Create account successful');
	    }
	    function getthongTinDonDatById($id){
			$this->id = $id;
			$sql = "select * from dondat where id = '$this->id'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			return $data;
		}
		function updateSoLuongMon($id,$monAn){
			$conn = open_database();
			$sql = "UPDATE donDat SET monan = '$monAn' WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');
			$conn->close();
		}
		function updatePhong($id,$phong){
			$conn = open_database();
			$sql = "UPDATE dondat SET phong = '$phong' WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');
			$conn->close();
		}
		function updateMon($id,$monAn){
			$conn = open_database();
			$sql = "UPDATE dondat SET monan = '$monAn' WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');
			$conn->close();
		}
		function updateTrangThai($id,$trangThai){
			$conn = open_database();
			$sql = "UPDATE dondat SET trangthai = '$trangThai' WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');
			$conn->close();
		}
	}
?>