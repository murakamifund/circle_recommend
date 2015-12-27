<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>サークルレコメンド</title>
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
	echo $this->html->css(array('style','style_inner','bootstrap'));
    echo $scripts_for_layout;
	echo $this->Html->script(array('myfunc.js','openclose.js','rollimg.js','scritp.js','slide_sample_pack.js'));
 
 ?>
 

<script type="text/javascript" src="js/openclose.js"></script>

</head>

<body>

<div id="container">

<div id="fixing_box">
<header>

<div id="logo"><a href="home"><img src="../img/logo03.png" width="250" height="50" alt=""></a></div>

<?php
	if(isset($_SESSION['tw_user_id'])){
?>

<div id="student_bar">
	<div id="student_bar_img"><img src="<?php echo $_SESSION['tw_image_url'];?>" alt="twitter"></div>
	<div id="student_bar_comment"><?php echo $_SESSION['tw_screen_name'];?>さんがログイン</div>
<?php
		if($_SESSION['is_circle']==true){
?>
	<div class="student_bar_btn"><a href="./circle_edit_main">マイページ</a></div>
<?php
		}else{
?>
	<div class="student_bar_btn"><a href="./student_edit">マイページ</a></div>
<?php
		}
?>
	<div class="student_bar_btn"><a href="./student_tw_logout">ログアウト</a></div>
</div>
<?php
	}else{
?>
<ul class="header_ul"><li><div onclick="display_popup()">ログインはこちら</div></li></ul>
<?php
	}
?>

</header>

<nav class="menubar" id="menubar_pc">
<ul>
<li id="current"><a class="menu_pc" href="../Students/home">HOME</a></li>
<li><a class="menu_pc" href="../Students/student">STUDENT</a></li>
<li><a class="menu_pc" href="../Students/circle">CIRCLE</a></li>
<?php
	if(isset($_SESSION['tw_user_id'])){
		if($_SESSION['is_circle']==true){
?>
	<li><a class="menu_pc" href="../Students/circle_edit_main">マイページ</a></li>
<?php
		}else{
?>
	<li><a class="menu_pc" href="../Students/student_edit">マイページ</a></li>
<?php
		}
	}else{
?>
	<li><a class="menu_pc" href="../Students/student_resister">ログイン</a></li>
<?php
	}
?>
	
</ul>
</nav>

<nav class="menubar" id="menubar_mobile">
<ul>
<li id="current"><a class="menu_mobile" href="home">HOME</a></li>
<li><a class="menu_mobile" href="student">STUDENT</a></li>
<li><a class="menu_mobile" href="circle">CIRCLE</a></li>
<?php
	if(isset($_SESSION['tw_user_id'])){
		if($_SESSION['is_circle']==true){
?>
	<li><a class="menu_mobile" href="../Students/circle_edit_main">マイページ</a></li>
<?php
		}else{
?>
	<li><a class="menu_mobile" href="../Students/student_edit">マイページ</a></li>
<?php
		}
	}else{
?>
	<li><a class="menu_mobile" href="../Students/student_resister">ログイン</a></li>
<?php
	}
?>

</ul>
</nav>

</div>

<div id="dummy_div">
</div>

<aside id="mainimg">
<a href="home" id="slide_link">
<img id="slide_image" src="../img/todai.jpg" alt="" width="977" height="260" />
</a>
</aside>

<div id="contents">

<div id="main">


<!--ここに書き込めば全体の枠になります -->
<?php echo $content_for_layout; ?>
	
</div>

<div id="sub">

<div class="box1 mb1em">

<nav>
<h2><a href="../Students/student_resister"><font color ="#66ccff">新規登録しよう</font></a></h2>
	<p>
	<!--<div class="i-btnb">
		<a href="../Students/student_resister">登録ページ</a>
	</div> -->
	<a href="../Students/student_resister"><font color ="#66ccff">新規登録</font></a>することでできること<br>
	(1)サークルのお気に入り、予定確認<br>
	(2)サークルの新規登録<br>
	(3)バイト、インターンのオファーの受け取り
	</p>
</nav>

</div>
<!--/box1-->

<aside class="box1 mb1em">
<h2>Twitterアカウント</h2>
<div id="twitter_box">
<a class="twitter-timeline" href="https://twitter.com/dekinaiyoooooo1" height="200" data-chrome="nofooter" data-widget-id="678444968457867264">@dekinaiyoooooo1さんのツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>


</aside>
<!--/box1-->

</div>
<!--/sub-->

<p id="pagetop"><a href="#">↑ PAGE TOP</a></p>



</div>
<!--/contents-->

<footer>
<small>Copyright&copy; 2014 <a href="home">SAMPLE CAFE</a>　All Rights Reserved.</small>
<span class="pr"><a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a></span>
</footer>


<div id="popup">
<h2>CIRCLE RECOMMENDERにログインしよう！</h2>
<p>ログインすると、もっとたくさんの写真が見れたり、気になるサークルの最新の新歓情報を受け取れたり、見比べたり出来るよ！</p>
<div id="popup_login_twitter">
	<p>Twitterから</p>
	<div><a href=""><img src="../img/twitter01.jpg" width="200" height="60"></a></div> 
</div>
<div id="popup_login_address">
	<p>メールアドレスから</p>
	<form action="" method="post">
	<input type="text" class="popup_login_form" name="address" value="メールアドレス" size="30"><br>
	<input type="text" class="popup_login_form" name="password" value="パスワード" size="20"><br>
	<div><a id="popup_remake_pass" href="">パスワードを忘れた方はこちら</a></div>
	<input id="popup_login_btn" type="submit" value="ログインする">
	</form>
</div>
<div><a href="student_resister" id="popup_to_register">未登録の方はこちら</a></div>
<div><a id="popup_close" onclick="close_popup()">もどる</a></div>
</div>



</div>
<!--/container-->


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
