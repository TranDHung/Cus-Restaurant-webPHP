<?php
	require_once('Database.php');
	require_once('BillDB.php');
	class NhanVien{
		protected $id;
		protected $ho;
		protected $ten;
		protected $ngaySinh;
		protected $gioi;
		protected $userName;
		protected $password;
		protected $type;
		public function dangNhap($userName, $password){
			$this->userName = $userName;
		   	$this->password = $password;

			$sql = "select * from account where userName = ?";
			$conn = open_database();
			
			$stm = $conn->prepare($sql);
			$stm -> bind_param('s',$this->userName);
			if (!$stm -> execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			$result = $stm->get_result();
			
			if($result->num_rows == 0){
				return array('code' => 1, 'error' => 'User does not exist');
			}
			
			$data = $result->fetch_assoc();
			
			$hashed_password = $data['password'];
			if(!password_verify($this->password, $hashed_password)){
				return array('code' => 2, 'error' => 'Invalid password');
			}else
				return array('code' => 0, 'error' => '','data' => $data);
		}
		public function dangXuat(){
		  	session_start();
		    session_destroy();
			header('Location: login.php');
		}
		public function doiMatKhau($userName, $newPass){
			$this->userName = $userName;
			$hash = password_hash($newPass, PASSWORD_DEFAULT);
			$this->password = $hash;
			$sql = "UPDATE account SET password='$this->password' WHERE userName='$this->userName'";
			$conn = open_database();
			if($conn->query($sql) === TRUE){
				return array('code' => 0, 'error' => 'Update pass successful');
			}
			return array('code' => 1, 'error' => 'Can not execute command');

			$conn->close();
		}
		public function chinhSuaThongTinCaNhan($object){
			$conn = open_database();
			$this->id = $object['id'];
			$this->ho = $object['ho'];
			$this->ten = $object['ten'];
			$this->ngaySinh = $object['ngays'];
			$this->gioi = $object['gioi'];
			$sql = "UPDATE account SET ten = '$this->ten',ho='$this->ho',ngaySinh = '$this->ngaySinh', gioi = '$this->gioi' WHERE id = '$this->id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');

			$conn->close();
		}
	}
	class ThuNgan extends NhanVien{
		public function quanLyHoaDon(){
			$sql = "select * from hoadon";
			$conn = open_database();
		
			return $result = $conn->query($sql);
		}
		public function lapHoaDon($object){
			$hoadon = new HoaDon();
			$hoadon->id = $hoadon->taoIDBill();
			$hoadon->nguoiLapDon = $object['tenNV'];
	    	$hoadon->tenKhach = $object['tenKhach'];
	    	$hoadon->monAn = $object['monAn'];
	    	$hoadon->ngayLap = $object['ngayLap'];
	    	$hoadon->phong = $object['phong'];
	    	$hoadon->thanhTien = $object['thanhTien'];
	    	$sql = "insert into hoadon(id,nguoilap,monan,phong,tenkhach,ngaylap,thanhtien) value(?,?,?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssssssi', $hoadon->id,$hoadon->nguoiLapDon,$hoadon->monAn,$hoadon->phong,$hoadon->tenKhach,$hoadon->ngayLap,$hoadon->thanhTien);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Create account successful');
		}
		public function xoaHoaDon($id){
			$hoadon = new HoaDon();
			$hoadon->id = $id;
			$sql = "delete from hoadon WHERE id = '$hoadon->id'";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Delete info successful');

			$conn->close();
		}
		public function getThongTinHoaDonById($id){
			$sql = "select * from hoadon where id = '$id'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			return $data;
		}
	}
	class QuanLy extends ThuNgan{
		public function quanLyNhanVien(){
			$sql = "select * from account";
			$conn = open_database();
		
			return $result = $conn->query($sql);
		}
		public function dangKy($object){
			$this->id = $object['id'];
			$this->ho = $object['ho'];
			$this->ten = $object['ten'];
			$this->ngaySinh = $object['ngays'];
			$this->gioi = $object['gioi'];
			$this->userName = $object['userName'];
			$this->type = $object['type'];
			$this->password = $object['pass'];
			if(isUsernameExists($this->userName)){
				return array('code' => 1, 'error' =>'Tên đăng nhập đã tồn tại');
			}
			$hash = password_hash($this->password, PASSWORD_DEFAULT);
			$sql = "insert into account(id,ho,ten,ngaySinh,gioi,userName,password,type) value(?,?,?,?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			$stm->bind_param('sssssssi', $this->id,$this->ho,$this->ten,$this->ngaySinh,$this->gioi,$this->userName,$hash,$this->type);
			if(!$stm->execute()){
				return array('code' => 2, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Create account successful');
		}
		public function xoaTaiKhoan($id){
			$conn = open_database();
			$sql = "delete from account WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Delete info successful');

			$conn->close();
		}
		public function chinhSuaTaiKhoan($object){
			$conn = open_database();
			$data = getUserName($object['id']);
			$this->id = $object['id'];
			$this->ho = $object['ho'];
			$this->ten = $object['ten'];
			$this->ngaySinh = $object['ngays'];
			$this->gioi = $object['gioi'];
			$this->userName = $object['userName'];
			$this->type = $object['type'];
			$this->password = $object['pass'];
			if($data['userName'] != $userName){
				if(isUsernameExists($userName)){
					return array('code' => 2, 'error' =>'Tên đăng nhập đã tồn tại');
				}
			}
			if(empty($this->password))
				$sql = "UPDATE account SET ho = '$this->ho',ten = '$this->ten',ngaySinh='$this->ngaySinh',gioi = '$this->gioi', userName = '$this->userName',type = '$this->type' WHERE id = '$this->id'";
			else{
				$hash = password_hash($this->password, PASSWORD_DEFAULT);
				$sql = "UPDATE account SET ho = '$this->ho',ten = '$this->ten',ngaySinh='$this->ngaySinh',gioi = '$this->gioi', userName = '$this->userName',password ='$hash',type = '$this->type' WHERE id = '$this->id'";
			}
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');

			$conn->close();

		}
		public function getthongTinNhanVienById($id){
			$sql = "select * from account where id = '$id'";
			$conn = open_database();
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			return $data;
		}
		public function quanLyThucDon(){
			$sql = "select * from monan";
			$conn = open_database();
		
			return $result = $conn->query($sql);
		}
		public function themMonAn($object){
			$anh = $object['anh'];
			$id = $object['id'];
			$viTri = $object['vitri'];
			$ten = $object['ten'];
			$gia = $object['gia'];
			if(isTenDishExists($id)){
				return array('code' => 2, 'error' =>'Tên món ăn đã tồn tại');
			}
			$sql = "insert into monan(id,ten,gia,anh,vitri) value(?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssisi', $id,$ten,$gia,$anh,$viTri);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Create account successful');
		}
		public function xoaMonAn($id){
			$conn = open_database();
			$sql = "delete from monan WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Delete info successful');

			$conn->close();
		}
		public function chinhSuaMonAn($object){
			$conn = open_database();
			$anh = $object['anh'];
			$id = $object['id'];
			$viTri = $object['vitri'];
			$ten = $object['ten'];
			$gia = $object['gia'];
			if(empty($anh)){
				$sql = "UPDATE monan SET ten = '$ten',gia = '$gia',vitri = '$viTri' WHERE id = '$id'";
			}
			else{
				$sql = "UPDATE monan SET ten = '$ten',gia = '$gia',anh = '$anh',vitri = '$viTri' WHERE id = '$id'";
			}
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');

			$conn->close();
		}
		public function quanLyDonDat(){
			$sql = "select * from dondat";
			$conn = open_database();
		
			return $result = $conn->query($sql);
		}
		public function xoaDonDat($id){
			$conn = open_database();
			$sql = "delete from dondat WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Delete info successful');
			$conn->close();
		}
		public function chinhSuaDonDat($id,$object){
			$ten = $object['ten'];
			$sdt = $object['sdt'];
			$ngay = $object['ngay'];
			$gio = $object['gio'];
			$phong = $object['phong'];
			$monan = $object['monan'];
			$soKhach = $object['sokhach'];
			$tongTien = $object['tongtien'];
			$conn = open_database();
			$sql = "UPDATE dondat SET tenkhach = '$ten',sdt = '$sdt',ngaydat='$ngay',giodat = '$gio',phong ='$phong',monan = '$monan',slkhach = '$soKhach',tongtien = '$tongTien' WHERE id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');
		}
		public function quanlyPhong(){
			$sql = "select * from phong";
			$conn = open_database();
		
			return $result = $conn->query($sql);
		}
		public function themPhong($object){
			$anh = $object['anh'];
			$id = $object['id'];
			$loai = $object['loai'];
			$succhua = $object['succhua'];
			$gia = $object['gia'];
			if(isIDPhongExists($id)){
				return array('code' => 2, 'error' =>'ID phòng đã tồn tại');
			}
			$sql = "insert into phong(id,kieuphong,gia,anh,succhua) value(?,?,?,?,?)";
			$conn = open_database();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssisi', $id,$loai,$gia,$anh,$succhua);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Create account successful');
		}
		public function xoaPhong($id){
			$conn  = open_database();
			$sql = "delete from phong where id = '$id'";
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Delete info successful');

			$conn->close();

		}
		public function chinhSuaPhong($object){
			$conn = open_database();
			$anh = $object['anh'];
			$id = $object['id'];
			$loai = $object['loai'];
			$succhua = $object['succhua'];
			$gia = $object['gia'];
			if(empty($anh)){
				$sql = "UPDATE phong SET kieuphong = '$loai',gia = '$gia',succhua = '$succhua' WHERE id = '$id'";
			}
			else{
				$sql = "UPDATE phong SET kieuphong = '$loai',gia = '$gia',anh = '$anh',succhua = '$succhua' WHERE id = '$id'";
			}
			$stm = $conn->prepare($sql);
			if(!$stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');
			}
			return array('code' => 0, 'error' => 'Update info successful');

			$conn->close();
		}
	}
?>