<script>
onload = function(){
	func_circle_id(<?php echo $man; ?>,<?php echo $woman; ?>);
}
</script>

<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));

$nomi_custom = array('飲まない','あまり飲まない','普通','飲む','かなり飲む');
$nomi_chosen = $nomi_custom[$nomi-1];

$mazime_custom = array('楽しくワイワイ','少しゆるい','普通','厳しめ','かなり厳しい');
$mazime_chosen = $mazime_custom[$mazime-1];

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
 
 

<!--ここからhtml-->

<div id="circle_left">
	<div id="circle_name">
		<a href="<?php echo $url; ?>"><?php echo $circle_name; ?></a>
	</div>
	<div id="circle_twitter">
		<a href="https://twitter.com/<?php echo $twitterid; ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true">@twitterさんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<div id="circle_photo">
		<img id="circle_photo_base" src="../../img/noimage.jpg" width="400" height="300" alt="NO IMAGE" >
		<img id="circle_photo_on"src="../../img/sample_photo2.jpg" width="400" height="300">
	</div>
	<div id="circle_pr">
		<?php echo $pr; ?>
	</div>
</div>
<div id="circle_right">
	<h4>活動内容</h4>
	<div><?php echo $act["$activity"];?></div>
	<h4>場所</h4>
	<div><?php echo $place; ?>　<?php echo $placetext; ?></div>
	<h4>曜日</h4>
	<div><?php echo $day_chosen; ?></div>
	<h4>費用</h4>
	<div>入会費：<?php echo $cost_in; ?>円　　年間費：<?php echo $cost; ?>円</div>
	<h4>メンバー構成</h4>
	<div><?php echo $intercollege; ?></div>
	<h4>男女比</h4>
	<div><table><tr><td id="man_ratio"><?php echo $man; ?></td><td id="woman_ratio"><?php echo $woman; ?></td></tr></table></div>
	<h4>雰囲気</h4>
	<div>飲み会頻度：<?php echo $nomi_chosen; ?><br>活動の雰囲気：<?php echo $mazime_chosen; ?></div>

</div>


<!--
<p>
<div class="stop-bottom">

<div class="stop-btm">
	<table class="type01">
		<tbody>
		
		<tr>
			<th scope="row">写真</th>
			<td></td>
		</tr>
		<tr>
			 <th scope="row">サークル名</th>
			<td><?php echo $circle_name; ?></td>
		</tr>
		<tr>
			<th scope="row">TwitterアカウントのID</th>

			<td><?php echo $twitterid; ?></td>
		</tr>
		<tr>
			<th scope="row">URL</th>
			<td><a href="<?php echo $url; ?>"><?php echo $circle_name; ?>のホームページ</a></td>
		</tr>
		<tr>
			<th scope="row">活動内容</th>
			<td><?php echo $activity; ?></td>
		</tr>
		<tr>
		 <th scope="row">PR文</th>
			<td><?php echo $pr; ?></td>
		</tr>
		<tr>
			<th scope="row">活動曜日</th>
		<td><?php echo $day_chosen; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
		<tbody>
		<tr>
			<th scope="row">主な活動場所</th>
			<td><?php echo $place; ?></td>
			<td><?php echo $placetext; ?></td>
		</tr>
	</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">男女比</th>
			<td><?php echo $man; ?></td>
			<td><div id="man_ratio">3</div><div id="woman_ratio">15</div></td>
			<td><?php echo $woman; ?></td>
		</tr>
	</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">構成</th>
			<td><?php echo $intercollege; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">活動費</th>
			<td>入会費<?php echo $cost_in; ?></td>
			<td>年間費<?php echo $cost; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td><?php echo $nomi_chosen; ?></td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
				<td><?php echo $mazime_chosen; ?></td>
		</tr>
	</tbody>
	</table>
</div>
</div>
</p>--> 

<br><br>

<h4>イベント情報</h4>
イベントをクリックすると、イベントの詳細に飛べます。

<p>
<div id="fc1" class="fc" >

</div>

<script>

	
	$('#fc1').fullCalendar({
		defaultDate: '2015-11-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			events:<?php echo  $json; ?>
			
			
	});
	
	
    
</script>
</p>
