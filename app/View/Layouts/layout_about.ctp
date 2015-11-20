<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>サークルレコメンド</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="copyright" content="Template Party">
<meta name="description" content="東京大学の部活動、サークル活動を紹介する情報サイト。その他東大生の大学生活に役に立つバイト情報やインターン情報を提供。">
<meta name="keywords" content="東大,部活,サークル,バイト,インターン,大学">

<!-- <link rel="stylesheet" href="css/style.css">  -->

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
    echo $this->Html->meta('icon');
	echo $this->html->css(array('style', 'bootstrap'));
    echo $scripts_for_layout;
	echo $this->Html->script(array('openclose.js','rollimg.js','scritp.js','slide_sample_pack.js'));
 ?>

<script type="text/javascript" src="js/openclose.js"></script>
</head>

<body>

<div id="container">

<header>
<h1><a href="home">サークルレコメンド</a></h1>
<p id="logo"><a href="home"><img src="../img/logo.png" width="270" height="50" alt=""></a></p>　　<!-->これがロゴの画像<!-->
</header>

<nav id="menubar">
<ul>
<li><a href="home">HOME</a></li>
<li id="current"><a href="about">ABOUT</a></li>
<li><a href="student">STUDENT</a></li>
<li><a href="../Circles/circle">CIRCLE</a></li>
<li><a href="student_resister">新規登録</a></li>
<li><a href="student_login">ログイン</a></li>
</ul>
</nav>

<aside id="mainimg">
<img class="slide_file" src="../img/1.jpg" title="home">
<img class="slide_file" src="../img/2.jpg" title="home">
<img class="slide_file" src="../img/3.jpg" title="home">
<input type="hidden" id="slide_loop" value="0">
<a href="home" id="slide_link">
<img id="slide_image" src="../img/1.jpg" alt="" width="977" height="260" />
<img id="slide_image2" src="../img/1.jpg" alt="" width="977" height="260" /></a>
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

<aside class="mb1em">
<h2>関連情報</h2>
<ul>
<li><a href="#">関連情報リンク</a></li>
<li><a href="#">関連情報リンク</a></li>
<li><a href="#">関連情報リンク</a></li>
<li><a href="#">関連情報リンク</a></li>
<li><a href="#">関連情報リンク</a></li>
</ul>
</aside>

<div class="box1 mb1em">

<section>
<h2>当ブロック内に画像を置く場合</h2>
<p>幅240pxまで。</p>
</section>

</div>
<!--/box1-->

<section>
<h2>box1の外は</h2>
<p>こんな感じです。ここに画像を置く場合、幅260pxまで。</p>
</section>

</div>
<!--/sub-->

<p id="pagetop"><a href="#">↑ PAGE TOP</a></p>

</div>
<!--/contents-->

<footer>
<small>Copyright&copy; 2014 <a href="home">SAMPLE CAFE</a>　All Rights Reserved.</small>
<span class="pr"><a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a></span>
</footer>

</div>
<!--/container-->

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
