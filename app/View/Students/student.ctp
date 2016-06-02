<?php $this->set('title_for_layout', 'サークル検索'); ?>
<?php $this->Html->meta('description', '自分の好みに合わせて東大の部活、サークルを検索。お気に入り登録やツイッターアカウントのフォローにより最新情報を入手!さらに予定もカレンダーで一括管理できます。', array('inline' => false)) ?>
<script>
onload = function(){
	func_student();	
}

</script>

<?php
	echo $this->Html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
?>
<h1>東大の人気サークル、部活を見つけよう!</h1>
<!-- サークルの新規登録を促す -->
<!--<aside class="mb1em"><img src="../img/image1.jpg" width="700" height="99" alt="" class="wa"></aside>-->

<!-- 検索フォーム -->

<form method="post" action="./student" name=form1 >

<h2>「キーワード」から東大のサークル、運動会を検索</h2>
	<div class="search_group">
		<div class="search_title">キーワード</div>
		<div class="search_forms2"><input type="textbox" name="keyword" id="search_keyword"  /></div>
		<input type="submit" value="検索" id="search_submit1" />
		例:) テニス 東大
	</div>
	<br>
</form>

<!--おすすめサークル一覧-->

<h2 class="mb1em">東大人気サークル・運動会一覧</h2>

<div id="search_result">人気のサークルはこちら!</div>
<div id="lists">

<?php 
	foreach ($top_data as $top_datum){ 
?>
	<div class="list">
		
		<div class="list_left">
			<div class="list_image"><img src="http://www.paper-glasses.com/api/twipi/<?=$top_datum['Circle']['tw_screen_name']?>/original" width="300" height="150" alt="" /></div>
		</div>
		<div class="list_right">
			<div class="list_right_top">
				<div class="list_catch_phrase"><?php echo htmlentities($top_datum['Circle']['phrase']); ?></div>
				<div class="list_name"><a href="../Students/circle_id/<?php echo htmlentities($top_datum['Circle']['id']); ?>"><?php echo htmlentities($top_datum['Circle']['circle_name']); ?></a></div>
			</div>
			<div class="list_right_middle">
				<div class="list_pr"><?php echo str_replace("\\n","",htmlentities($top_datum['Circle']['pr'])); ?></div>
				<div class="list_tags">#<?php echo htmlentities($top_datum['Circle']['activity']); ?></div>
				<div class="list_tags">#場所:<?php echo htmlentities($top_datum['Circle']['place']); ?></div>
				<div class="list_tags">#<?php echo htmlentities($top_datum['Circle']['intercollege']); ?></div>
			</div>
			<div class="list_right_bottom">

<?php
			if(isset($_SESSION['is_circle']) && $_SESSION['is_circle'] == true){	//サークルでのログイン状態
				;
			}else if($top_datum['Circle']['favored']==true){		//すでにお気に入りされていたら
?>
				<form action="unfav/<?php echo htmlentities($top_datum['Circle']['id']);?>" method="post">
					<input type="hidden" name="address" value="student">
					<input type="image" src="../img/okiniiri.png" onmouseover="this.src='../img/okiniiri_1.png'" onmouseout="this.src='../img/okiniiri.png'" width="150" height="28" alt="おすすめ" class="icon"/>
				</form>
<?php
			}else if(isset($_SESSION['tw_user_id'])){		//お気に入りされていなくて生徒でのログインであったら
?>
				<form action="fav/<?php echo htmlentities($top_datum['Circle']['id']);?>" method="post">
					<input type="hidden" name="address" value="student">
					<input type="image" src="../img/okiniiri_1.png" onmouseover="this.src='../img/okiniiri.png'" onmouseout="this.src='../img/okiniiri_1.png'" width="150" height="28" alt="おすすめ" class="icon"/>
				</form>
<?php
			}else{		//ログインしていなかったら
			$_SESSION['fav_id'] = $top_datum['Circle']['id'];		//お気に入りしたサークルのidをセッションに保存しておく
?>
				<img src="../img/okiniiri_1.png" onmouseover="this.src='../img/okiniiri.png'" onmouseout="this.src='../img/okiniiri_1.png'"  onclick="display_popup()" width="150" height="100" alt="おすすめ" class="not_login icon">
				<!--<input type="hidden" name="address" value="student_edit">--> 	<!--ここで一旦favする気があったことを判別するためにsessionに保存 -->

<?php
			}
?>

			<div class="list_twitter"><a href="https://twitter.com/<?php echo htmlentities($top_datum['Circle']['tw_screen_name']); ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $top_datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
			<div class="list_bottan"><a href="../Students/circle_id/<?php echo htmlentities($top_datum['Circle']['id']); ?>">詳細はこちら！</a></div>
			</div>
	</div>
</div>
<?php
	//メモリの解放
	unset($top_datum);
}
?>
</div>
