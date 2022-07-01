<?php
	class HoaDon{
		public $id;
		public $nguoiLapDon;
		public $monAn = '';
		public $phong;
		public $tenKhach;
		public $ngayLap;
		public $thanhTien;

		public function taoIDBill(){
			date_default_timezone_set("Asia/Bangkok");
			$year = date('y');
			$month = date('m');
			$day = date('d');
			$hour = date('H');
			$minute = date('i');
			$second = date('s');
			$id = $day.''.$month.''.$year.''.$hour.''.$minute.''.$second;
			return $id;
		}
	}
?>