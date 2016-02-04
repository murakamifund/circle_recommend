<script>
onload = function(){
	func_circle_edit_main();	
}
</script>
<!--ここからhtml -->
<title>UT-Circle サークルページ</title>
<h2> <?php echo $circle_name; ?>の情報を管理</h2>

<?php
	echo $this->Html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
	
$nomi_custom = array('少ない','やや少ない','普通','多い','かなり多い');
if(isset($nomi)){
	$nomi_chosen = $nomi_custom[$nomi-1];
}
else{
	$nomi_chosen = '';
}

$mazime_custom = array('楽しくワイワイ','少しゆるい','普通','厳しめ','かなり厳しい');
if(isset($mazime)){
	$mazime_chosen = $mazime_custom[$mazime-1];
}
else{
	$mazime_chosen = '';
}
$day_custom = array('月','火','水','木','金','土','日');
$day_chosen = "";

for($i=0; $i<7;$i++){
	if($day[$i]==1) $day_chosen .= $day_custom[$i] .= " ";
}

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

 ?>

<div id="circle_top">
	<div id="circle_name"><?php echo $circle_name; ?></div>
	<a href="https://twitter.com/<?php echo $tw_screen_name; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $circle_name; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>

<div id="circle_left">
	
	<div id="circle_photo">
		<img id="circle_photo_on" src=<?php echo $tw_profile_banner_url; ?> width="400px" height="150px" onerror="this.src='../img/noimage.jpg'">

	</div>
	
	<h4>活動紹介</h4>
	<div id="circle_pr">
	<?php if($pr != NULL){
				echo str_replace("\\n","<br>",$pr);
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>ホームページURL</H4>
	<div>
	<?php
		if($url != ""){
	?>
		<a href="<?=$url?>"><font color = "#0000ff"><?=$url?></font></a>
	<?php
		}else{
			echo 'ホームページが登録されていません';
		}
	?>
	</div>
</div> <!--circle_leftのdiv終わり-->
<div id="circle_right">
	<h4>活動内容</h4>
	<div>
	<?php if($activity != NULL){
				echo $activity;
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>場所</h4>
	<div>
	<?php if($place != NULL and $placetext != NULL){
				echo $place;
				echo $placetext;
			}
			else if($place != NULL){
				echo $place;
			}
			else if($placetext != NULL){
				echo $placetext;
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>曜日</h4>
	<div>
	<?php if($day_chosen != NULL){
				echo $day_chosen;
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>費用</h4>
	<div>入会費：
	<?php if($cost_in != NULL){ ?>
	<?php			echo $cost_in; ?>円
	<?php		}
			else{
				echo "情報がありません。";
			}
	?>
	<br>
	年間費：
	<?php if($cost != NULL){ ?>
	<?php			echo $cost; ?>円
	<?php		}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>メンバー構成</h4>
	<div>
	<?php if($intercollege != NULL){
				echo $intercollege;
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
	
	<h4>男女比</h4>
	<div>
	<?php	if($man != NULL and $woman != NULL){ ?>
	<table><tr><td id="man_ratio"><?php echo $man; ?></td><td id="woman_ratio"><?php echo $woman; ?></td></tr></table>
	<?php	}else{
			echo "情報がありません。";
	?>
	<?php
			} 
	?>
	</div>
	
	<h4>雰囲気</h4>
	<div>飲み会頻度：
	<?php if($nomi_chosen != NULL){
				echo $nomi_chosen;
			}
			else{
				echo "情報がありません。";
			}
	?>
	<br>
	活動の雰囲気：
	<?php if($mazime_chosen != NULL){
				echo $mazime_chosen;
			}
			else{
				echo "情報がありません。";
			}
	?>
	</div>
</div><!--circle_rightのdiv終わり-->
<br><br><br>



<h3>情報を編集</h3>
<div class="stop-bottom">
<div class="stop-btm">
<p>
		<div class="i-btn">
			<div Align="center">
			<a href="circle_edit">詳細を編集</a>&nbsp;　&nbsp;　&nbsp;　&nbsp;　&nbsp;　
			<a href="circle_edit_cal">予定を編集</a>
			</div>
		</div>

</p>
<p>
	<font size="3" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
	</font>
</p>
</div>
</div>


<h3>サークルの登録情報を削除</h3>
<p>
	<div Align="right">
	<?php echo $this->Form->postLink('サークル情報を削除',array(
		'action'=>'del',
		$id),array('class'=>'btn btn-info'),'サークル情報を消去してもよろしいですか?');?>
	</div>
</p>


<h3>ログアウト</h3>
<div class="stop-bottom">
<div class="stop-btm">
	<div Align="right">
		<div class="i-btn">
			<a href="student_tw_logout">ログアウト</a>
		</div>
	</div>
</div>
</div>
