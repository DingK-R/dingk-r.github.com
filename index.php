<html>
	<head>
		<title>FreeDKR</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="http://lib.sinaapp.com/js/bootstrap/2.2.1/css/bootstrap.min.css">
		<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.js"></script>
		<script type="text/javascript" src="http://lib.sinaapp.com/js/bootstrap/2.2.1/js/bootstrap.min.js"></script>
		<style>
			.login_index {
				background-color: #F6F6F6;
				font-family: Lato;
			}
		</style>
	</head>
	<body style="padding:60">
		<div class="container">
			<div class="alert alert-info">
				<center><h1>Just for fun</h1></center>
			</div>
			<center>
			<form class="form-horizontal" acction="index.php" method="post">
				<input type="text" style="height:30" class="span3" name="mid" placeholder="Music ID" />
				<input type="submit" class="btn btn-danger">
			</form>
			</center>
			<?php
				function getLocation($location)
				{
					$loc_2 = (int)substr($location, 0, 1);
					$loc_3 = substr($location, 1);
					$loc_4 = floor(strlen($loc_3) / $loc_2);
					$loc_5 = strlen($loc_3) % $loc_2;
					$loc_6 = array();
					$loc_7 = 0;
					$loc_8 = '';
					$loc_9 = '';
					$loc_10= '';
					while ($loc_7 < $loc_5) {
						$loc_6[$loc_7] = substr($loc_3, ($loc_4 +1)*$loc_7, $loc_4 + 1);
						$loc_7++;
					}
					$loc_7 = $loc_5;
					while ($loc_7 < $loc_2) {
						$loc_6[$loc_7] = substr($loc_3, $loc_4 * ($loc_7 - $loc_5) + ($loc_4 + 1) * $loc_5, $loc_4);
						$loc_7++;
					}
					$loc_7 = 0;
					while ($loc_7 < strlen($loc_6[0])) {
						$loc_10 = 0;
						while ($loc_10 < count($loc_6)) {
							$loc_8 .= $loc_6[$loc_10][$loc_7];
							$loc_10++;
						}
						$loc_7++;
					}
					$loc_9 = str_replace('^', 0, urldecode($loc_8));
					return $loc_9;
				}
				$mid = (int)$_POST['mid'];
				if (empty($mid))
					return false;
				$url = "http://www.xiami.com/widget/xml-single/uid/0/sid/$mid";
				$new = new DOMDocument();
				$new->load($url);
				$res = $new->getElementsByTagName("track");
				foreach($res as $arr) {
					$no1 = $arr->getElementsByTagName("location");
					$no1_v = $no1->item(0)->nodeValue;
				}
				$href = getLocation($no1_v);
				echo "<center>";
				echo '<div class="well"><p>'.$href.'</p>';
				echo '<p>wget 这个地址 或者下载工具</p></div>';
				echo "</center>";
			?>
		</div>
	</body>
</html>
<!-- 凯撒阵列加密 解密算法 -->
