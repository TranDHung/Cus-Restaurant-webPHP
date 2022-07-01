<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		.div-dichvu{
			width: 1200px;
			height: 1530px;
			margin: auto;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px;
			box-shadow: 0 0 5px 0 #ccc;
			border-radius: 5px;
		}
		.dichvu{
			box-shadow: 0 0 5px 0 #ccc;
			width: 550px;
			height: 620px;
			padding: 50px;
			margin-bottom: 30px;
			border-radius: 5px;
		}
		.searchbar{
	      width: 300px; 
	      height: 40px; 
	      border-top-left-radius: 3px; 
	      border-bottom-left-radius: 3px; 
	      border: none;
	      margin-left: 100px;
	    }
	    .searchbar:focus{
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
	<script type="text/javascript">
		function showContact(){
	    document.getElementById("contactInfo").style.display = "block";
	    }
	    function hideContact(){
	      document.getElementById("contactInfo").style.display = "none";
	    }
	</script>
</head>
<nav class="navbar navbar-expand-sm" style="background-color: #B40404;">
    <a href="index.php" class="navbar-brand"><img src="Image/logo.png" class="float-left" width="200px" height="60px"></a>
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
	<div class="div-dichvu">
		<div class="dichvu">
			<div class="text-birthday" style="font-size: 33px;">
				TIỆC SINH NHẬT
			</div>
			<div class="birthday-content" style="font-size: 19px;">
				Nếu đời người là một con đường dài thì mỗi sự kiện là một mốc son quan trọng ghi lại những chặng đường đã qua, đánh dấu sự trưởng thành, những kỷ niệm mà ta không muốn đánh mất, để dễ dàng tìm lại, để cùng nhau sẻ chia,...  Mỗi sự kiện, mỗi buổi tiệc chào mừng, liên hoan, sinh nhật hay ngày kỷ niệm riêng đều rất quan trọng.
				<br>
				Trong ngày trọng đại của cuộc đời, bạn muốn chu toàn cho từng khoảnh khắc, bạn muốn ghi dấu ấn với những người thân yêu, hãy tận hưởng hạnh phúc trong ngày trọng đại, và để chúng tôi thay bạn lên kế hoạch và triển khai.
				<br>
				Với những bữa tiệc chỉn chu đến từng chi tiết, chúng tôi tin rằng mỗi sự kiện tại Việt Phố không chỉ giúp lưu giữ những khoảnh khắc và cảm xúc vô giá để mang theo suốt cuộc đời bạn và còn thể hiện được đúng cá tính và phong cách của chủ tiệc.
			</div>
		</div>
		<img src="https://i.pinimg.com/originals/da/48/fb/da48fbdea9a97d1165f1a006e79786c5.jpg" style="float: right; width: 450px; height: 620px; margin-top: -650px; margin-right: 20px;">
		<div class="dichvu" style="height: 800px;">
			<div class="text-birthday" style="font-size: 33px;">
				TIỆC CHIÊU ĐÃI KHÁCH HÀNG
			</div>
			<div class="birthday-content" style="font-size: 19px;">
				Hệ Thống nhà hàng Việt Phố - Không gian sang trọng  đẳng cấp là địa điểm lý tưởng tổ chức cho tiệc họp mặt, tiệc chiêu đãi đối tác, tiệc kỷ niệm thành lập công ty, tiệc liên hoan công ty,...
				<br>
				VỊ TRÍ ĐỊA LÝ:
				<br>
				Tọa lạc tại Quận 3 và Quận 5, một trong những quận đắt đỏ và nhộn nhịp bật nhất Thành phố. Với bãi đỗ xe rộng rãi và hơn hết là dịch vụ bãi xe tốt nhất Sài Gòn luôn làm hài lòng khách hàng.
				<br>
				DỊCH VỤ CHUYÊN NGHIỆP:
				<br>
				Đội ngũ nhân viên được lựa chọn và đào tạo nghiệp vụ chuyên biệt.
				<br>
				THỰC ĐƠN "NGON ĐẶC SẮC":
				<br>
				Ẩm thực là một phần quan trọng thay lời cảm ơn của chủ tiệc gửi tới khách mời. Chúng tôi luôn tự hào về đội ngũ đầu bếp có thể đáp ứng yêu cầu khắt khe nhất về ẩm thực của mỗi vị khách.
				<br>
				KIẾN TRÚC KHÔNG GIAN:
				<br>
				Mỗi phòng tiệc mang nét kiến trúc riêng độc đáo được trau chuốt tỉ mỉ với nội thất sang trọng.
				<br>
				ƯU ĐÃI TIỆC:
				<br>
				Nhà hàng luôn có các gói tiệc đáp ứng nhu cầu đa dạng của khách hàng.
			</div>
		</div>
		<img src="https://b.zmtcdn.com/data/reviews_photos/e06/b012107a5b740bb0ba8ee5371921de06_1612529245.jpg" style="float: right; width: 450px; height: 800px; margin-top: -830px; margin-right: 20px;">
	</div>
</body>
</html>