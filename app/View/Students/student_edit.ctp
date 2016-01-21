<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
?>

<script>
onload = function(){
	func_student_edit();
}
</script>

<h2> <?php echo $user_name; ?>の情報を管理</h2>
	<div id="student_menu">
	<div class="i-btn"><a href="#" onclick="student_edit_func(0);">ユーザ情報</a></div>
	<div class="i-btn"><a href="#" onclick="student_edit_func(1);">お気に入り</a></div>
	<div class="i-btn"><a href="#" onclick="student_edit_func(2);">カレンダー</a></div>
	<div class="i-btn"><a href="student_tw_logout">ログアウト</a></div>
</div>

<div id="student_edit_content0">
<h3>基本データ</h3>
<div id="circle_left">
	<div id="circle_photo">
		<img id="circle_photo_base" src="../../img/noimage.jpg" width="200" height="150" alt="NO IMAGE" >
		<img id="circle_photo_on"src=<?php echo $user_profile_image; ?> width="110" height="110">
	</div>
</div>
<div id="circle_right">
	<h4>お名前</h4>
	<div><?php echo $user_name?></div>
	<h4>自己紹介</h4>
	<div><?php echo $user_description; ?></div>
</div>
</div>

<div id="student_edit_content1">	
<h3 class="mb1em">お気に入り登録サークル</h3>

<?php
		foreach ($data as $datum){ 
?>
	<div class="list">
		<div class="list_left">
			<div class="list_image"><img src="<?php echo $datum['Circle']['tw_profile_image_url']; ?>" width="300" height="150" alt="" /></div>
		</div>
		<div class="list_right">
			<div class="list_right_top">
				<div class="list_name"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>"><?php echo $datum['Circle']['circle_name']; ?></a></div>
				<div class="list_catch_phrase"><?php echo $datum['Circle']['phrase']; ?></div>
			</div>
			<div class="list_right_middle">
				<div class="list_pr"><?php echo str_replace("\\\\\\\\\\\\\\\\n","",$datum['Circle']['pr']); ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['activity']; ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['place']; ?></div>
				<div class="list_tags">#<?php echo $datum['Circle']['intercollege']; ?></div>
			</div>
			<div class="list_right_bottom">
			<div class="list_twitter"><a href="https://twitter.com/<?php echo $datum['Circle']['tw_screen_name']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
			<div class="list_bottan"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>">詳細はこちら！</a></div>
			</div>
	</div>
</div>
<?php
		}
?>
</div>

<div id="student_edit_content2">
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
</div>