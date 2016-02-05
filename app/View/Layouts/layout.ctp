<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="copyright" content="Template Party">
<meta name="description" content="東京大学の部活動、サークル活動を紹介する情報サイト。その他東大生の大学生活に役に立つバイト情報やインターン情報を提供。">
<meta name="keywords" content="東大,部活,サークル,バイト,インターン,大学">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
    echo $this->Html->meta('icon');
	echo $this->Html->css(array('style','style_inner','bootstrap'));
    echo $scripts_for_layout;
	echo $this->Html->script(array('myfunc.js','openclose.js','rollimg.js','scritp.js','slide_sample_pack.js'));
 
 ?>
 

<script type="text/javascript" src="js/openclose.js"></script>

</head>

<body>

	<div id="container">

		<div id="fixing_box"><!--固定部分 -->
			<header>
				<div id="logo"><a href="home"><img src="../img/logo03.png"  alt=""></a></div>
				<div id="logo_mini"><a href="home"><img src="../img/twitter_icon.png"  alt=""></a></div>
<?php
	if(isset($_SESSION['tw_user_id'])){	//ログインしている場合
?>

				<div id="student_bar">
					<div id="student_bar_img"><img src="<?php echo $_SESSION['tw_image_url'];?>" alt="twitter"></div>
					<div id="student_bar_comment"><?php echo $_SESSION['tw_screen_name'];?>さんがログイン</div>

<?php
		if($_SESSION['is_circle']==true){	//サークルでログイン
?>
					<div class="student_bar_btn"><a href="./circle_edit_main">マイページ</a></div>
<?php
		}else{	//生徒でログイン
?>
					<div class="student_bar_btn"><a href="./student_edit">マイページ</a></div>
<?php
		}
?>
					<div class="student_bar_btn"><a href="./student_tw_logout">ログアウト</a></div>
				
				</div><!--/#student_bar -->
<?php
	}else{	//ログインしていない場合
?>
				<div id="header_login" onclick="display_popup()">ログインはこちら</div>
<?php
	}
?>
			</header>

			<nav class="menubar" id="menubar_pc">
				<ul>
					<li><a class="menu_pc" href="../Students/home">HOME</a></li>
					<li><a class="menu_pc" href="../Students/student">学生の方</a></li>
					<li><a class="menu_pc" href="../Students/circle">サークルの方</a></li>
				</ul>
			</nav>

		</div><!--/#fixing_box -->

		<div id="dummy_div"></div>

		<aside id="mainimg">
			<div id="iconlist-wrapper">
				<div id="iconlist-main">
					<div id="iconlist-reel">

						<div id="thumb-main" data-width="400">
							<div>UT-Circle</div>
							<div>気になったサークルをクリック！<br />詳細な内容が分かるよ！</div>
						</div>

					<!-- Thumb Items -->
<?php
	for($i=0;$i<30;$i++){
		if($i<count($suggest_circle)){
?>
						<article class="thumb">
							<a href="../Students/circle_id/<?=$suggest_circle[$i]['Circle']['id']?>" class="image">
								<img src="http://www.paper-glasses.com/api/twipi/<?=$suggest_circle[$i]['Circle']['tw_screen_name']?>/original" width="100%" alt="">
							</a>
							<div class="thumb_msg" onclick="location(../Students/circle_id/<?=$suggest_circle[$i]['Circle']['id']?>)">
								<a href="../Students/circle_id/<?=$suggest_circle[$i]['Circle']['id']?>"><?=$suggest_circle[$i]['Circle']['circle_name']?></a>
							</div>
						</article>
<?php
		}else{
?>
						<article class="thumb">
							<a href="#" class="image"><img src="../img/egg.png" width="100%" alt=""></a>
							<div class="thumb_msg">テンプレートでっす</div>
						</article>
<?php
		}
	}
?>															
					</div>
				</div>
			</div>
		</aside><!--/#mainimg -->


		<div id="contents">
		
			<div id="main">	
				<?=$content_for_layout?>
			</div><!--/#main -->

			<div id="sub">
				<aside class="box1 mb1em">
					<h2>Twitterアカウント</h2>
					<div id="twitter_box">
						<a class="twitter-timeline" href="https://twitter.com/dekinaiyoooooo1" height="200" data-chrome="nofooter" data-widget-id="678444968457867264">@dekinaiyoooooo1さんのツイート</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				</aside><!--/box1-->
			</div><!--/sub-->

			<p id="pagetop"><a href="#">↑ PAGE TOP</a></p>
		</div><!--/contents-->

		<footer>
			<small>Copyright&copy; 2016 <a href="home">UT-Circle</a>　<a href="about">利用規約</a><br>連絡先: utcircle.psi@gmail.com</small>
			<span class="pr"><a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a></span>
		</footer>


		<div id="popup">
			<h2>UT-Circleに<nobr>ログインしよう！</nobr></h2>
			<p><a href="pre_student_tw_callback"><img src="../img/image3.png"></a></p>
			<div id="popup_login_twitter" class="i-btn">
				<a href="pre_student_tw_callback"><nobr>Twitterで</nobr><nobr>ログイン</nobr></a>
			</div> 
			<div id="popup_to_circle" ><a href="./circle">サークルの方はこちら</a></div>
			<div><a id="popup_close" onclick="close_popup()">×</a></div>
		</div> <!--/#popup-->

	</div><!--/container-->


	<div id="overlay" onclick="close_popup();"></div>

<!--スライドショースクリプト-->
<script type="text/javascript" src="js/slide_simple_pack.js"></script>

<!--スマホ用更新情報-->
<script type="text/javascript">
if (OCwindowWidth() < 480) {
	open_close("newinfo_hdr", "newinfo");
}
</script>

</body>
</html>
