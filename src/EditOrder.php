<?php
  ob_start();
  session_start();
  require('RoomDB.php');
  require('MenuDB.php');
  require('TheOrderDB.php');
  require('AccountDB.php');
  ob_flush();
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
    body{
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
      z-index: 10; 
      position: absolute;
      text-align: center;
      border-radius: 20px;
      left: 0; 
      top: 0; 
      height: 200px;
      margin-top: 160px;
      margin-left: 130px;
    }
    .total-bill{
      padding: 20px;
      color: black;
    }
    .price-total-in-cart{
      color: black;
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
    .confirm-update{
      text-align: right;
      padding-right: 30px;
    }
    .confirm-btn{
      background: #0040FF;
      color: white;
      margin-top: 10px;
      margin-bottom: 30px;
      font-weight: bold;
      border-radius: 5px;
      height: 40px;
      width: 100px;
      border: none;
    }
    .themMon{
      background:green;
      width: 97px;
      border-radius: 3px 3px 3px 3px;
    }
    .doiPhong{
      background: green;
      width: 97px;
      border-radius: 3px 3px 3px 3px;
    }
    #sokhach::-webkit-outer-spin-button,
    #sokhach::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .return-btn{
      background: lightgray;
      margin-left: 8px;
      color: black;
      margin-top: 10px;
      margin-bottom: 30px;
      font-weight: bold;
      border-radius: 5px;
      height: 40px;
      width: 100px;
      border: none;
    }
  </style>
<?php
    $tongTien = 0;
    $donDat = new DonDat();
    $result = $donDat->getthongTinDonDatById($_SESSION['id']);
    $id = $result['id'];
    $tenKhach = $result['tenkhach'];
    $sdt = $result['sdt'];
    $ngay = $result['ngaydat'];
    $gio = $result['giodat'];
    $phong = $result['phong'];
    $monAn = $result['monan'];
    $soKhach = $result['slkhach'];
    $loaiDon = $result['loaidon'];
    $danhSach = explode(',',$monAn);
    $danhSachMonAn = [];
    $danhSachSoLuong = [];
    $object = [];
    $error1 = '';
    if(isset($_SESSION['ten']) && isset($_SESSION['sdt']) && isset($_SESSION['ngay']) && isset($_SESSION['gio']) && isset($_SESSION['soluongkhach'])){
      $tenKhach = $_SESSION['ten'];
      $sdt = $_SESSION['sdt'];
      $ngay = $_SESSION['ngay'];
      $gio = $_SESSION['gio'];
      $soKhach = $_SESSION['soluongkhach'];
    }
    if(isset($_POST['submit']) && isset($_POST['tenkhach']) && isset($_POST['sdt']) && isset($_POST['ngay']) && isset($_POST['gio']) && isset($_POST['sokhach'])) {
      $tenKhach = $_POST['tenkhach'];
      $sdt = $_POST['sdt'];
      $ngay = $_POST['ngay'];
      $gio = $_POST['gio'];
      $sokhach = $_POST['sokhach'];
      if (empty($tenKhach)) {
          $error1 = 'Vui lòng nhập tên khách hàng!';
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
      else if (empty($monAn)) {
          $error1 = 'Không có món ăn cho buổi tiệc';
      }else{
        $object['ten'] = $tenKhach;
        $object['sdt'] = $sdt;
        $object['ngay'] = $ngay;
        $object['gio'] = $gio;
        $object['sokhach'] = $soKhach;
        $object['monan'] = $monAn;
        $object['phong'] = $phong;
        $object['tongtien'] = $_POST['submit'];
        $quanly = new QuanLy();
        $result = $quanly->chinhSuaDonDat($id,$object);
        if($result['code'] == 1){
          $error1 = 'Không thành công! Vui lòng thử lại sau';
        }else{
          reSetPage();
          if(isset($_SESSION['editPay'])){
            unset($_SESSION['editPay']);
            header("Location: IndexMaPay.php");
          }else
            header("Location: IndexMaOrder.php");
        }
      }
    }
    foreach ($danhSach as $mon) {
      $monVaSoLuong = explode(':',$mon);
      if(!empty($monVaSoLuong[1])){
        array_push($danhSachMonAn, $monVaSoLuong[0]);
        array_push($danhSachSoLuong, $monVaSoLuong[1]);
      }
    }
    function capNhatMonAn($danhSachSoLuong,$danhSachMonAn){
      $danhSach = [];
      for($i = 0;$i<count($danhSachMonAn);$i++){
        $danhSach[$danhSachMonAn[$i]] = $danhSachSoLuong[$i];
      }
      $monAn = '';
      foreach ($danhSach as $key => $value) {
        $string = $key.':'.$value;
        $monAn .= $string.',';
      }
      return $monAn;
    }
    if(isset($_POST['minus'])){
      luuThayDoi();
      if($danhSachSoLuong[$_POST['minus']] > 1){
        $danhSachSoLuong[$_POST['minus']] = $danhSachSoLuong[$_POST['minus']] - 1;
        $monAn = capNhatMonAn($danhSachSoLuong,$danhSachMonAn);
        $donDat->updateSoLuongMon($id,$monAn);
      }
      header("Location: EditOrder.php");
    }
    if(isset($_POST['plus'])){
      luuThayDoi();
      $danhSachSoLuong[$_POST['plus']] = $danhSachSoLuong[$_POST['plus']] + 1;
      $monAn = capNhatMonAn($danhSachSoLuong,$danhSachMonAn);
      $donDat->updateSoLuongMon($id,$monAn);
      header("Location: EditOrder.php");
    }
    if(isset($_POST['delete'])){
      luuThayDoi();
      array_splice($danhSachMonAn, $_POST['delete'], 1);
      array_splice($danhSachSoLuong, $_POST['delete'], 1);
      $monAn = capNhatMonAn($danhSachSoLuong,$danhSachMonAn);
      $donDat->updateSoLuongMon($id,$monAn);
      header("Location: EditOrder.php");
    }
    if(isset($_POST['themMon'])){
      luuThayDoi();
      $_SESSION['monAn'] = $_POST['themMon'];
      header("Location: AddDishInOrder.php");
    }
    if(isset($_POST['doiPhong'])){
      luuThayDoi();
      $_SESSION['update'] = true;
      $_SESSION['loaidon'] = $loaiDon;
      $_SESSION['sokhach'] = $_POST['doiPhong'];
      header("Location: ChooseRoom.php");
    }
    function luuThayDoi(){
      $_SESSION['ten'] = $_POST['tenkhach'];
      $_SESSION['sdt'] = $_POST['sdt'];
      $_SESSION['ngay'] = $_POST['ngay'];
      $_SESSION['gio'] = $_POST['gio'];
      $_SESSION['soluongkhach'] = $_POST['sokhach'];
    }
    function reSetPage(){
      unset($_SESSION['monAn']);
      unset($_SESSION['update']);
      unset($_SESSION['loaidon']);
      unset($_SESSION['sokhach']);
      unset($_SESSION['ten']);
      unset($_SESSION['sdt']);
      unset($_SESSION['ngay']);
      unset($_SESSION['gio']);
      unset($_SESSION['soluongkhach']);
    }
    if(isset($_POST['reset'])){
      reSetPage();
      header('Location: EditOrder.php');
    }
?>
</head>
<body>
  <form method="post" id="capNhat">
  <div class="customer-info">
    <div class="title-cart" style="margin-top: 20px;">
      <img src="https://vietpho.com.vn/public/app/new/booking/vp_files/T-custom-info.png">
    </div><hr class="short-line">
    <div class="field">
      <span>Họ và Tên:</span>
      <input class="form-control" type="text" value="<?=$tenKhach?>" name="tenkhach">
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
      <input class="form-control" type="number" value="<?= $soKhach?>" name="sokhach" id="sokhach"
      <?php
       if($loaiDon == 2){
        ?>
        min ="1"  max="20"
        <?php
        }
      ?>
      >
    </div>
    <?php
      if (!empty($error1)) {
          echo "<div style = 'width: 440px;background-color:#F78181;border-radius:4px 4px 4px 4px;text-align:center;margin-left:775px;'>$error1</div>";
      }
    ?>
  </div>
  <hr>
  <div class="food-list" style="overflow: auto;">
    <div class="title-cart">
      <img src="Image/dishes.png">
    </div><hr class="short-line">
    <button class="themMon" style="position: absolute; right: 30px; top: 505px; color: white; border: none;" name="themMon" value="<?=$monAn?>" type="submit">Thêm món</button>
    <div class="div-khaivi">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Khai vị</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'kv'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
            $tongTien = $tongTien + ($soluong*$result['gia']);
      ?>
      <div class="food">
        <img class="food-img" src="Image/khaivi/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="minus" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="plus" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
        </div>
        <button class="delete" style="background-color: white;margin: 4px;" name="delete" value="<?= $i ?>" type = "submit" onclick="return confirm('Chắc chắn muốn xóa?')"><i class="fa fa-close"></i></button>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="div-chinh">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Món chính</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'mc'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
            $tongTien = $tongTien + ($soluong*$result['gia']);
      ?>
      <div class="food">
        <img class="food-img" src="Image/monchinh/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="minus" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="plus" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
        </div>
        <button class="delete" style="background-color: white;margin: 4px;" name="delete" value="<?= $i ?>" type = "submit" onclick="return confirm('Chắc chắn muốn xóa?')"><i class="fa fa-close"></i></button>
      </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="div-trangmieng">
      <h2 class="line" style="padding-top: 10px;"><span style="color: red;">Tráng miệng</span></h2>
      <?php
        for($i = 0; $i<count($danhSachMonAn); $i++) {
          if(substr($danhSachMonAn[$i], 0, 2) == 'tm'){
            $soluong = $danhSachSoLuong[$i];
            $monAn = new MonAn();
            $result = $monAn->getThongTinMonAnById($danhSachMonAn[$i]);
            $tongTien = $tongTien + ($soluong*$result['gia']);
      ?>
      <div class="food">
        <img class="food-img" src="Image/trangmieng/<?= $result['anh']?>">
        <div class="text-cost"><?=$monAn->productPrice($result['gia'])?> đ</div>
        <div class="food-name"><span><?= $result['ten']?></span></div>
        <div class="soluong">
          <span>Số lượng</span>
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="minus" value="<?= $i?>" type="submit"><i class="fa fa-minus"></i></button>
          <input class="quantity" type="text" readonly value="<?= $soluong?>" name="soluong" min="0" max="100">
          <button class="changeNumber" style="border: none; background-color:#8A0808;" name="plus" value="<?= $i?>" type="submit"><i class="fa fa-plus"></i></button>
        </div>
        <button class="delete" style="background-color: white;margin: 4px;" name="delete" value="<?= $i ?>" type = "submit" onclick="return confirm('Chắc chắn muốn xóa?')"><i class="fa fa-close"></i></button>
      </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
  <?php
    if($phong != '0'){
      $room = new Phong();
      $result = $room->getthongTinPhongById($phong);
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
  <button class="doiPhong" style="color: white; border: none; position: absolute;  right: 30px; top: 1415px;" name="doiPhong" value="<?=$soKhach?>" type="submit" form = "capNhat">Đổi phòng</button>
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
    </div>
  </div>
  <div class="confirm-update">
    <div class="div-of-total">
      <button class="confirm-btn" type="submit" form="capNhat" name="submit" onclick="return alert('Cập nhật thông tin thành công!');" value="<?= $tongTien ?>">CẬP NHẬT</button>
      <button class="return-btn" name="reset" form="capNhat" type="submit">Reset</button>
    </div>
  </div>
</body>
</html>