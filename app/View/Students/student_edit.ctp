<?php
	echo $this->Html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
?>

<script>
onload = function(){
	func_student_edit();
}
</script>

<title>UT-Circle マイページ</title>

<h2> <?php echo $user_name; ?>さんの情報を管理</h2>
	<div id="student_menu">
	<div class="i-btn"><a href="#" onclick="student_edit_func(0);">ページ全体</a></div>
	<div class="i-btn"><a href="#" onclick="student_edit_func(1);">カレンダー</a></div>
	<div class="i-btn"><a href="#" onclick="student_edit_func(2);">お気に入り</a></div>
	<div class="i-btn"><a href="student_tw_logout">ログアウト</a></div>
</div>

<div id="student_edit_content0">
<h3>基本データ</h3>
<div id="lists">
	<div class="list">
		<div class="list_left">
			<div class="list_image"><img src="<?php echo $user_profile_image; ?>" width="300" height="150" alt="" /></div>
		</div>
		<div class="list_right">
			<div class="list_right_top">
				<div class="list_name"><?php echo $user_name?></div> <!--名前-->
			</div><!--list_right_top end -->
			<div class="list_right_middle">
				<div class="list_pr"><?php echo $user_description; ?></div>
				
				<div class="list_tags">#東大</div>
				<!--
				<div class="list_tags">#<?php echo $datum['Circle']['activity']; ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['place']; ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['intercollege']; ?></div>
				-->
			</div>
		</div>
	</div>
</div>
<br><br>
</div>


<div id="student_edit_content1">
<h3 class="mb1em">新歓カレンダー</h3>
<p>
<div id="fc1" class="fc" >

</div>

<script>

	
	$('#fc1').fullCalendar({
		defaultDate: '2015-11-12',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			events:<?php echo  $json; ?>
			
			
	});
</script>
</p>
</div><!--student_edit_content1 end-->

<div id="student_edit_content2">	
<h3 class="mb1em">お気に入り登録サークル</h3>

<?php
	if(!$data){
?>
	<div id="search_result">お気に入り登録済みのサークルはありません。</div>
<?php	
	}
		foreach ($data as $datum){ 
?>
	<div class="list">
		<div class="list_left">
			<div class="list_image"><img src="http://www.paper-glasses.com/api/twipi/<?=$datum['Circle']['tw_screen_name']?>/original" width="300" height="150" alt="" /></div>
		</div>
		<div class="list_right">
			<div class="list_right_top">
				<div class="list_name"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>"><?php echo $datum['Circle']['circle_name']; ?></a></div>
				<div class="list_catch_phrase"><?php echo $datum['Circle']['phrase']; ?></div>
			</div>
			<div class="list_right_middle">
				<div class="list_pr"><?php echo str_replace("\\n","",$datum['Circle']['pr']); ?></div>
				<div class="list_tags">#(種目):<?php echo $datum['Circle']['activity']; ?></div>
				<div class="list_tags">#(場所):<?php echo $datum['Circle']['place']; ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['intercollege']; ?></div>
			</div>
			<div class="list_right_bottom">

			<form action="/circle_recommend/Students/unfav/<?php echo $datum['Circle']['id']; ?>" method="post">
				<input type="hidden" name="address" value="student_edit">
				<input type="image" src="../img/okiniiri.png" onmouseover="this.src='../img/okiniiri_1.png'" onmouseout="this.src='../img/okiniiri.png'" width="150" height="28" alt="おすすめ" class="icon"/>
			</form>
			<div class="list_twitter"><a href="https://twitter.com/<?php echo $datum['Circle']['tw_screen_name']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
			<div class="list_bottan"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>">詳細はこちら！</a></div>
			</div>
	</div>
</div>
<?php
		}
?>
</div><!--student_edit_content2 end-->