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
	
	$act=array(
		"1"=>'テニス',"2"=>'卓球',"3"=>'サッカー',"4"=>'野球',"5"=>'バスケ',"6"=>'バレー',"7"=>'バドミントン',"8"=>'ラグビー',"9"=>'ホッケー',"10"=>'水泳',
		"11"=>'武道',"12"=>'ダンス',"13"=>'登山',"14"=>'乗り物',"15"=>'スキー',
		"31"=>'政治・経済',"32"=>'放送・広告',"33"=>'語学',"34"=>'国際',"35"=>'コンピュータ',"36"=>'自然科学',"37"=>'法学',"38"=>'企業',
		"51"=>'ロック',"52"=>'ジャズ',"53"=>'クラシック',"54"=>'コーラス',
		"61"=>'映画・写真',"62"=>'演劇・お笑い',"63"=>'美術',"64"=>'文芸',
		"71"=>'旅行',"72"=>'アウトドア',"73"=>'ゲーム',"74"=>'グルメ',"75"=>'芸能',
		"81"=>'その他'
	);

	//$requested == true　ならば適切に検索している
	//$found == true ならば検索結果が存在する
	$requested = false;
	$found = false;
	if($this->request->data){
		for($i=0;$i<37;$i++){
			if($activity[$i]=="On")$requested = true;		
		}	
		if($word != "")$requested = true;
		if(count($data)>0)$found = true;
	}

	//検索していないor検索結果がない場合の表示
	if(!$requested || !$found){
?>
<h2>サークルを探そう</h2>
<!-- サークルの新規登録を促す -->
<aside class="mb1em"><img src="../img/image1.jpg" width="700" height="99" alt="" class="wa"></aside>


<?php
		if($requested){
?>
<div id="search_result">検索結果がありませんでした。検索し直してみてください。</div>
<?php
		}
?>

<!-- 検索フォーム -->



<form method="post" action="./student" name=form1 >

	<h4>キーワードから探す</h4>
	<div class="search_group">
		<div class="search_title">キーワード</div>
		<div class="search_forms2"><input type="textbox" name="keyword" id="search_keyword"  /></div>
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


<!--おすすめサークル一覧-->

<h2 class="mb1em">人気サークル一覧</h2>

<div id="search_result">いま人気のサークルはこちら！</div>
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

<?php
	//検索結果があった場合の表示
	}else if($requested && $found){
		$string = "";	
		$i = 0;
	
		foreach ($data as $datum){
			$string .= $datum['Circle']['circle_name'];	
			if (count($data) != $i)$string .= ",";		
			$i++;	
		}
?>
<div id="search_result">
	<div><?php echo count($data); ?>件のサークルが見つかりました！<br>結果をツイートして友達を誘ってみましょう！ </div>
	<div id="search_result_tw"><a href = "https://twitter.com/share" data-hashtags= <?php echo $string; ?> data-text = 'このサークルの新歓に行く人は一緒に行こう！' data-url = '' data-size = 'large' class="twitter-hashtag-button" >Tweet #ut-circle</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>	
</div>
<br></br>

<h2 class="mb1em">イベントカレンダー</h2>
イベント名をクリックすると、そのイベントの詳細を見ることができます。

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

<!--検索結果一覧-->

<div id="lists">
<h2 class="mb1em">サークル一覧</h2>
<?php
	$i=0;
	foreach ($data as $datum){
	$i+=1;
?>
	<div id="list<?php echo $i; ?>">
	<div class="list">
		<div class="list_left">
			<div class="list_image"><img src="http://www.paper-glasses.com/api/twipi/<?=$datum['Circle']['tw_screen_name']?>/original" width="300" height="150" alt="" /></div>
		</div>
		<div class="list_right">
			<div class="list_right_top">
				<div class="list_catch_phrase"><?php echo htmlentities($datum['Circle']['phrase']); ?></div>
				<div class="list_name"><a href="../Students/circle_id/<?php echo htmlentities($datum['Circle']['id']); ?>"><?php echo htmlentities($datum['Circle']['circle_name']); ?></a></div>
			</div>
			<div class="list_right_middle">
				<div class="list_pr"><?php echo str_replace("\\n","",htmlentities($datum['Circle']['pr'])); ?></div>
				<div class="list_tags">#<?php echo htmlentities($datum['Circle']['activity']); ?></div>
				<div class="list_tags">#場所:<?php echo htmlentities($datum['Circle']['place']); ?></div>
				<div class="list_tags">#<?php echo htmlentities($datum['Circle']['intercollege']); ?></div>
			</div>
			<div class="list_right_bottom">
<?php
			if(isset($_SESSION['is_circle']) && $_SESSION['is_circle'] == true){
				;
			}else if($datum['Circle']['favored']==true){
?>
				<form action="unfav/<?php echo htmlentities($datum['Circle']['id']);?>" method="post">
					<input type="hidden" name="address" value="student">
					<input type="image" src="../img/okiniiri.png" onmouseover="this.src='../img/okiniiri_1.png'" onmouseout="this.src='../img/okiniiri.png'" width="150" height="28" alt="おすすめ" class="icon"/>
				</form>
<?php
			}else if(isset($_SESSION['tw_user_id'])){
?>
				<form action="fav/<?php echo htmlentities($datum['Circle']['id']);?>" method="post">
					<input type="hidden" name="address" value="student">
					<input type="image" src="../img/okiniiri_1.png" onmouseover="this.src='../img/okiniiri.png'" onmouseout="this.src='../img/okiniiri_1.png'" width="150" height="28" alt="おすすめ" class="icon"/>
				</form>
<?php
			}else{
?>
				<img src="../img/okiniiri_1.png" onmouseover="this.src='../img/okiniiri.png'" onmouseout="this.src='../img/okiniiri_1.png'" onclick="display_popup()" width="150" height="100" alt="おすすめ" class="not_login icon">
<?php
			}
?>
			<div class="list_twitter"><a href="https://twitter.com/<?php echo htmlentities($datum['Circle']['tw_screen_name']); ?>" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large" data-dnt="true"><?php echo $datum['Circle']['circle_name']; ?>さんをフォロー</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
			<div class="list_bottan"><a href="../Students/circle_id/<?php echo htmlentities($datum['Circle']['id']); ?>">詳細はこちら！</a></div>
			</div>
		</div>
	</div>
	</div>
<?php
		}
?>
<?php
		$limit = 5;
		$count = count($data);
		$last = ($count-($count-1)%$limit-1)/$limit+1;
?>

<script>
<?php for($i=1; $i<$count+1; $i++){ ?>
	document.getElementById('list<?php echo $i; ?>').style.display = 'none';
<?php } ?>
<?php for($i=1; $i<$limit+1; $i++){ ?>
	document.getElementById('list<?php echo $i; ?>').style.display = 'block';
<?php } ?>
</script>

<?php for($i=1; $i<$last+1; $i++){ ?>
	<input type="button" value="<?php echo $i; ?>" id="pager" onclick="
	<?php for($j=1; $j<$count+1; $j++){ ?>
		document.getElementById('list<?php echo $j; ?>').style.display = 'none';
	<?php } ?>
	<?php for($j=($i-1)*$limit+1; $j<$i*$limit+1; $j++){ ?>
		document.getElementById('list<?php echo $j; ?>').style.display = 'block';
	<?php } ?>
	">
<?php } ?>
</div>

<!--
<div id=page>
<?php
		$prev = $page-1;
		$next = $page+1;
		$count = count($data);
		$last = ($count-$count%$limit)/$limit+1;
?>
<?php if($page>2){ ?>
<form method="post" action="./1" name=page_form1 >
<input type="submit" value="1" id="page_submit1"/>
<?php echo "..."; ?>
<?php } ?>
<?php if($page>1){ ?>
<form method="post" action="./<?php echo $prev; ?>" name=page_form2 >
<input type="submit" value="<?php echo $prev; ?>" id="page_submit2"/>
<?php } ?>
<form method="post" action="./<?php echo $page; ?>" name=page_form3 >
<input type="submit" value="<?php echo $page; ?>" id="page_submit3"/>
<?php if($page<$last){ ?>
<form method="post" action="./<?php echo $next; ?>" name=page_form4 >
<input type="submit" value="<?php echo $next; ?>" id="page_submit4"/>
<?php } ?>
<?php if($page<$last-1){ ?>
<?php echo "..."; ?>
<form method="post" action="./<?php echo $last; ?>" name=page_form5 >
<input type="submit" value="<?php echo $last; ?>" id="page_submit5"/>
<?php } ?>
</div>

<?php } ?>
-->

<!--
		<a class="twitter-timeline" href="https://twitter.com/<?php echo $datum['Circle']['tw_screen_name']; ?>" height="200" width="100"  data-chrome="nofooter" data-widget-id="667297834580836352">@<?php echo $datum['Circle']['tw_screen_name']; ?>さんのツイート</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
-->