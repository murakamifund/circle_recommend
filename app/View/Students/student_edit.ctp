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
<h3>基本データ</h3>
<div id="circle_left">
	<div id="circle_name">
		<!--
		<a href="<?php echo $url; ?>"><?php echo $circle_name; ?></a>
<?php
		if($favored){
?>
		<img src="../../img/icon_ninki.png" width="90" height="60" alt="人気" class="icon">
<?php
		}else if(isset($_SESSION['tw_user_id'])){
?>
		<form action="/circle_recommend/Students/fav/<?php echo $circle_id;?>" method="post">
		<input type="image" src="../../img/icon_osusume.png" width="90" height="60" alt="おすすめ" class="icon"/>
		</form>
<?php
		}else{
?>
		<img src="../../img/icon_osusume.png" onclick="display_popup()"  width="90" height="60" alt="おすすめ" class="icon">
<?php
		}
?>
	-->
	</div>
	
	<div id="circle_photo">
		
		<img id="circle_photo_base" src="../../img/noimage.jpg" width="200" height="150" alt="NO IMAGE" >
		<img id="circle_photo_on"src=<?php echo $user_profile_image; ?> width="200" height="150">
	
		<!-- ツイッターの埋め込み 
		
		<a class="twitter-timeline" href="https://twitter.com/<?php echo $tw_screen_name; ?>" height="300" data-chrome="nofooter" data-widget-id="667297834580836352">@<?php echo $tw_screen_name; ?>さんのツイート</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		-->
	</div>
	<!--
	<div id="circle_pr">
		<?php echo nl2br($pr); ?>
	</div>
	-->
</div>
<div id="circle_right">
	<h4>お名前</h4>
	<div><?php echo $user_name?></div>
	<h4>自己紹介</h4>
	<div><?php echo $user_description; ?></div>
	

</div>


<h3>ログアウト</h3>
<p>
	<div Align="right">
		<div class="i-btn">
			<a href="student_tw_logout">ログアウト</a>
		</div>
	</div>
</p>    
	
<h3 class="mb1em">お気に入り登録サークル</h3>




<?php 
	for ($i=0;$i<count($user_favorite_circle);$i++){
		echo $user_favorite_circle[$i];
	?>
	<br>
	<?php
	}
?>

<!--
<?php foreach ($local_circle as $top_datum){ ?>
<section class="list">
<div class="list_top">
	<div class="list_catch_phrase"><?php echo $top_datum['Circle']['phrase']; ?></div>
	<div class="list_tags"><?php echo $top_datum['Circle']['place']; ?></div>
	<div class="list_tags"><?php echo $top_datum['Circle']['intercollege']; ?></div>
<?php
	if($top_datum['Circle']['favored']==true){
?>
	<img src="../img/star2.png" width="90" height="60" alt="人気" class="icon">
<?php
	}else if(isset($_SESSION['tw_user_id'])){
?>
	<form action="/circle_recommend/Students/fav/<?php echo $top_datum['Circle']['id'];?>" method="post">
	<input type="hidden" name="address" value="student">
	<input type="image" src="../img/star1.png" width="90" height="60" alt="おすすめ" class="icon"/>
	</form>
<?php
	}else{
?>
	<img src="../img/star1.png" onclick="display_popup()" width="90" height="60" alt="おすすめ" class="icon">
<?php
	}
?>
	<div class="list_name"><a href="../Students/circle_id/<?php echo $top_datum['Circle']['id']; ?>"><?php echo $top_datum['Circle']['circle_name']; ?></a></div>
	<div class="list_twitter"><a href="https://twitter.com/<?php echo $top_datum['Circle']['tw_screen_name']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $top_datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>

</div>
<div class="list_body">
	<div class="list_image"><img src="../img/sample_photo1.jpg" width="300" height="150" alt="" /></div>
	<div class="list_pr"><?php echo nl2br($top_datum['Circle']['pr']); ?></div>
	<div class="list_bottan"><a href="../Students/circle_id/<?php echo $top_datum['Circle']['id']; ?>">詳細はこちら！</a></div>
</div>
</section>
	
<?php } ?>
-->

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

