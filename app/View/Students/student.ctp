<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
?>

<script>
onload = function(){
	func_student();	
}
</script>

<aside class="mb1em"><img src="../img/image1.jpg" width="700" height="99" alt="" class="wa"></aside>
<!-- 上の画像で、サークルの新規登録を促す -->
<h2>サークルを探そう</h2>
<?php
	if(!$this->request->data){
?>

<form method="post" action="./student" name=form1 >


	<h4>キーワードから探す</h4>
	<div class="search_group">
		<div class="search_title">キーワード：</div>
		<div class="search_forms2"><input type="textbox" name="keyword" id="search_keyword" size="50" /></div>
		<input type="submit" value="検索" id="search_submit1" />
	</div>
	<br>
	<h4>カテゴリから探す</h4>
	<div class="search_group">
		<div class="search_title">スポーツ</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check1" id="activity1" value="1" />テニス</lavel>
			<lavel><input type="checkbox" name="check2" id="activity2" value="1" />卓球</lavel>
			<lavel><input type="checkbox" name="check3" id="activity3" value="1" />サッカー</lavel>
			<lavel><input type="checkbox" name="check4" id="activity4" value="1" />野球</lavel>
			<lavel><input type="checkbox" name="check5" id="activity5" value="1" />バスケ</lavel>
			<lavel><input type="checkbox" name="check6" id="activity6" value="1" />バレー</lavel>
			<lavel><input type="checkbox" name="check7" id="activity7" value="1" />バドミントン</lavel>
			<lavel><input type="checkbox" name="check8" id="activity8" value="1" />ラグビー</lavel>
			<lavel><input type="checkbox" name="check9" id="activity9" value="1" />ホッケー</lavel>
			<lavel><input type="checkbox" name="check10" id="activity10" value="1" />水泳</lavel>
			<lavel><input type="checkbox" name="check11" id="activity11" value="1" />武道</lavel>
			<lavel><input type="checkbox" name="check12" id="activity12" value="1" />ダンス</lavel>
			<lavel><input type="checkbox" name="check13" id="activity13" value="1" />登山</lavel>
			<lavel><input type="checkbox" name="check14" id="activity14" value="1" />乗り物</lavel>
			<lavel><input type="checkbox" name="check15" id="activity15" value="1" />スキー</lavel>
		</div>
	</div>
	<div class="search_group">
		<div class="search_title">アカデミー</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check31" id="activity31" value="1" />政治・経済</lavel>
			<lavel><input type="checkbox" name="check32" id="activity32" value="1" />放送・広告</lavel>
			<lavel><input type="checkbox" name="check33" id="activity33" value="1" />語学</lavel>
			<lavel><input type="checkbox" name="check34" id="activity34" value="1" />国際</lavel>
			<lavel><input type="checkbox" name="check35" id="activity35" value="1" />コンピュータ</lavel>
			<lavel><input type="checkbox" name="check36" id="activity36" value="1" />自然科学</lavel>
			<lavel><input type="checkbox" name="check37" id="activity37" value="1" />法学</lavel>
			<lavel><input type="checkbox" name="check38" id="activity38" value="1" />企業</lavel>
		</div>
	</div>
	<div class="search_group">
		<div class="search_title">音楽</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check51" id="activity51" value="1" />ロック</lavel>
			<lavel><input type="checkbox" name="check52" id="activity52" value="1" />ジャズ</lavel>
			<lavel><input type="checkbox" name="check53" id="activity53" value="1" />クラシック</lavel>
			<lavel><input type="checkbox" name="check54" id="activity54" value="1" />コーラス</lavel>
		</div>
	</div>
	<div class="search_group">
		<div class="search_title">アート</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check61" id="activity61" value="1" />映画・写真</lavel>
			<lavel><input type="checkbox" name="check62" id="activity62" value="1" />演劇・お笑い</lavel>
			<lavel><input type="checkbox" name="check63" id="activity63" value="1" />美術</lavel>
			<lavel><input type="checkbox" name="check64" id="activity64" value="1" />文芸</lavel>
		</div>
	</div>
	<div class="search_group">
		<div class="search_title">趣味</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check71" id="activity71" value="1" />旅行</lavel>
			<lavel><input type="checkbox" name="check72" id="activity72" value="1" />アウトドア</lavel>
			<lavel><input type="checkbox" name="check73" id="activity73" value="1" />ゲーム</lavel>
			<lavel><input type="checkbox" name="check74" id="activity74" value="1" />グルメ</lavel>
			<lavel><input type="checkbox" name="check75" id="activity75" value="1" />芸能</lavel>
		</div>
	</div>
	<div class="search_group">
		<div class="search_title">その他</div>
		<div class="search_forms">
			<lavel><input type="checkbox" name="check81" id="activity81" value="1" />その他</lavel>
		</div>
	</div>
	
	<br><br>
		
	<h4>特徴から探す</h4>
		
	<div class="search_group">
		<div class="search_title">検索条件</div>
		<div class="search_forms2">
			<select  name="radio1" size="1">
				<option>練習したい</option>
				<option>楽な方がいい</option>
				<option>飲みたい</option>
				<option>飲みたくない</option>
				<option>インカレがいい</option>
				<option>学内がいい</option>
				<option>人数重視</option>
				<option selected>デフォルト</option>
			</select>
		</div>
		<br>
		<input type="submit" value="検索" id="search_submit2"/>
		<br>
	</div>
</form>

<?php
	}
?>

<section id="lunch">

<h3 class="mb1em">カレンダー</h3>
団体名をクリックすると、その団体の詳細に飛べます。

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


<h3 class="mb1em">サークル一覧</h3>

<?php
$year =date("Y",time());
$a=$year-2000;
$b=$a+($a-$a%4)/4-($a-$a%100)/100+($a-$a%400)/400;
$s3=($b+3)%7;
$s4=($b+6)%7;
$s5=($b+1)%7;
$d=0;	
$act=array(
	"1"=>'テニス',
	"2"=>'卓球',
	"3"=>'サッカー',
	"4"=>'野球',
	"5"=>'バスケ',
	"6"=>'バレー',
	"7"=>'バドミントン',
	"8"=>'ラグビー',
	"9"=>'ホッケー',
	"10"=>'水泳',
	"11"=>'武道',
	"12"=>'ダンス',
	"13"=>'登山',
	"14"=>'乗り物',
	"15"=>'スキー',
	"31"=>'政治・経済',
	"32"=>'放送・広告',
	"33"=>'語学',
	"34"=>'国際',
	"35"=>'コンピュータ',
	"36"=>'自然科学',
	"37"=>'法学',
	"38"=>'企業',
	"51"=>'ロック',
	"52"=>'ジャズ',
	"53"=>'クラシック',
	"54"=>'コーラス',
	"61"=>'映画・写真',
	"62"=>'演劇・お笑い',
	"63"=>'美術',
	"64"=>'文芸',
	"71"=>'旅行',
	"72"=>'アウトドア',
	"73"=>'ゲーム',
	"74"=>'グルメ',
	"75"=>'芸能',
	"81"=>'その他'
);
if($this->request->data){	
	for($i=0;$i<37;$i++):	
		if($activity[$i]=="On"):	
			$d=$d+1;	
		endif;	
	endfor;	
	if($word != ""):
		$d=$d+1;
	endif;
}
?>

<?php if($d>0): ?>
<h1>あなたにおすすめのサークルは・・・</h1>
<br>

<h5><font color =#0099ff>結果をツイートして友達を誘おう</font></h5>	
<?php 
$string = "";	
$i = 0;?>	
<?php foreach ($data as $datum):	
$string .= $datum['Circle']['circle_name'];	
if (count($data) != $i){	
$string .= ",";	
}	
$i = $i + 1;	
endforeach ?>	
<a href = "https://twitter.com/share" data-hashtags= <?php echo $string; ?> data-text = 'このサークルの新歓に行く人は一緒に行こう！' data-url = '' data-size = 'large' class="twitter-hashtag-button" >Tweet #circlerecommend</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>	
<br></br>






	<!--ツイッターの埋め込み　よくわからんからここに置きます。大きさはwidthとheightをいじればできます。白井さんよろしく-->
<!--
		<a class="twitter-timeline" href="https://twitter.com/<?php echo $datum['Circle']['tw_screen_name']; ?>" height="200" width="100"  data-chrome="nofooter" data-widget-id="667297834580836352">@<?php echo $datum['Circle']['tw_screen_name']; ?>さんのツイート</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
-->

<?php endif; ?>



<?php if($d==0): ?>
<h1>今人気のサークルはこちら！</h1>
<?php foreach ($top_data as $top_datum){ ?>
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
<?php endif; ?>
	
	
<?php if($d>0): ?>
<?php foreach ($data as $datum){ ?>
<section class="list">
<div class="list_top">
	<div class="list_catch_phrase"><?php echo $datum['Circle']['phrase']; ?></div>
	<div class="list_tags"><?php echo $datum['Circle']['place']; ?></div>
	<div class="list_tags"><?php echo $datum['Circle']['intercollege']; ?></div>
<?php
	if($datum['Circle']['favored']==true){
?>
	<img src="../img/star2.png" width="90" height="60" alt="人気" class="icon">
<?php
	}else if(isset($_SESSION['tw_user_id'])){
?>
	<form action="/circle_recommend/Students/fav/<?php echo $datum['Circle']['id'];?>" method="post">
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

	<div class="list_name"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>"><?php echo $datum['Circle']['circle_name']; ?></a></div>
	<div class="list_twitter"><a href="https://twitter.com/<?php echo $datum['Circle']['tw_screen_name']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>

</div>
<div class="list_body">
	<div class="list_image"><img src="../img/sample_photo1.jpg" width="300" height="150" alt="" /></div>
	<div class="list_pr"><?php echo nl2br($datum['Circle']['pr']); ?></div>
	<div class="list_bottan"><a href="../Students/circle_id/<?php echo $datum['Circle']['id']; ?>">詳細はこちら！</a></div>
</div>


</section>
<?php
	}
	endif;
?>


<!--/lunch-->
