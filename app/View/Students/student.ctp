<script>
onload = function(){
	func_student();	
}
</script>

<aside class="mb1em"><img src="../img/banner1.jpg" width="700" height="99" alt="ランチタイムパン食べ放題" class="wa"></aside>
<!-- 上の画像で、サークルの新規登録を促す -->
<h2>サークルを探そう</h2>

<ul class="navmenu">
<li><a href="#lunch">ランチメニュー</a></li>
<li><a href="#course">コースメニュー</a></li>
<li><a href="#single">単品メニュー</a></li>
<li><a href="#drink">ドリンクメニュー</a></li>
<li><a href="#desert">デザートメニュー</a></li>
<li><a href="#desert">デザートメニュー</a></li>
<li><a href="#desert">デザートメニュー</a></li>
</ul>

条件を入力すればおすすめのサークルを表示します
<br><br>

<form method="post" action="./student" name=form1>
	<table class = "type01">
	<tbody>
	<tr>
	<th scope="row">キーワード検索</th>
		<td>
		<input type="textbox" name="keyword" id="word" size="40" />
		</td>
	<tr>
	<th scope="row">種目</th>
		<td>
		スポーツ<br>
			<input type="checkbox" name="check1" id="activity1" value="1" />
			<lavel for="activity1">テニス　</lavel>
			<input type="checkbox" name="check2" id="activity2" value="1" />
			<lavel for="activity2">卓球　</lavel>
			<input type="checkbox" name="check3" id="activity3" value="1" />
			<lavel for="activity3">サッカー　</lavel>
			<input type="checkbox" name="check4" id="activity4" value="1" />
			<lavel for="activity4">野球　</lavel>
			<br>
			<input type="checkbox" name="check5" id="activity5" value="1" />
			<lavel for="activity5">バスケ　</lavel>
			<input type="checkbox" name="check6" id="activity6" value="1" />
			<lavel for="activity6">バレー　</lavel>
			<input type="checkbox" name="check7" id="activity7" value="1" />
			<lavel for="activity7">バドミントン　</lavel>
			<input type="checkbox" name="check8" id="activity8" value="1" />
			<lavel for="activity8">ラグビー　</lavel>
			<br>
			<input type="checkbox" name="check9" id="activity9" value="1" />
			<lavel for="activity9">ホッケー　</lavel>
			<input type="checkbox" name="check10" id="activity10" value="1" />
			<lavel for="activity10">水泳　</lavel>
			<input type="checkbox" name="check11" id="activity11" value="1" />
			<lavel for="activity11">武道　</lavel>
			<input type="checkbox" name="check12" id="activity12" value="1" />
			<lavel for="activity12">ダンス　</lavel>
			<br>
			<input type="checkbox" name="check13" id="activity13" value="1" />
			<lavel for="activity13">登山　</lavel>
			<input type="checkbox" name="check14" id="activity14" value="1" />
			<lavel for="activity14">乗り物　</lavel>
			<input type="checkbox" name="check15" id="activity15" value="1" />
			<lavel for="activity15">スキー　</lavel>
			<br><br>
		アカデミー<br>
			<input type="checkbox" name="check31" id="activity31" value="1" />
			<lavel for="activity31">政治・経済　</lavel>
			<input type="checkbox" name="check32" id="activity32" value="1" />
			<lavel for="activity32">放送・広告　</lavel>
			<input type="checkbox" name="check33" id="activity33" value="1" />
			<lavel for="activity33">語学　</lavel>
			<input type="checkbox" name="check34" id="activity34" value="1" />
			<lavel for="activity34">国際　</lavel>
			<br>
			<input type="checkbox" name="check35" id="activity35" value="1" />
			<lavel for="activity35">コンピュータ　</lavel>
			<input type="checkbox" name="check36" id="activity36" value="1" />
			<lavel for="activity36">自然科学　</lavel>
			<input type="checkbox" name="check37" id="activity37" value="1" />
			<lavel for="activity37">法学　</lavel>
			<input type="checkbox" name="check38" id="activity38" value="1" />
			<lavel for="activity38">企業　</lavel>
			<br><br>
		音楽<br>
			<input type="checkbox" name="check51" id="activity51" value="1" />
			<lavel for="activity51">ロック　</lavel>
			<input type="checkbox" name="check52" id="activity52" value="1" />
			<lavel for="activity52">ジャズ　</lavel>
			<input type="checkbox" name="check53" id="activity53" value="1" />
			<lavel for="activity53">クラシック　</lavel>
			<input type="checkbox" name="check54" id="activity54" value="1" />
			<lavel for="activity54">コーラス　</lavel>
			<br><br>
		アート<br>
			<input type="checkbox" name="check61" id="activity61" value="1" />
			<lavel for="activity61">映画・写真　</lavel>
			<input type="checkbox" name="check62" id="activity62" value="1" />
			<lavel for="activity62">演劇・お笑い　</lavel>
			<input type="checkbox" name="check63" id="activity63" value="1" />
			<lavel for="activity63">美術　</lavel>
			<input type="checkbox" name="check64" id="activity64" value="1" />
			<lavel for="activity64">文芸　</lavel>
			<br><br>
		趣味<br>
			<input type="checkbox" name="check71" id="activity71" value="1" />
			<lavel for="activity71">旅行　</lavel>
			<input type="checkbox" name="check72" id="activity72" value="1" />
			<lavel for="activity72">アウトドア　</lavel>
			<input type="checkbox" name="check73" id="activity73" value="1" />
			<lavel for="activity73">ゲーム　</lavel>
			<input type="checkbox" name="check74" id="activity74" value="1" />
			<lavel for="activity74">グルメ　</lavel>
			<br>
			<input type="checkbox" name="check75" id="activity75" value="1" />
			<lavel for="activity75">芸能　</lavel>
			<br><br>
		その他<br>
			<input type="checkbox" name="check81" id="activity81" value="1" />
			<lavel for="activity81">その他　</lavel>
		</td>
	</tr>
	<th scope="row">活動場所</th>
		<td>
		<input type="radio" value="駒場" name="radio1" id="komaba" />
		<lavel for="mazime1">駒場　</lavel>
		<input type="radio" value="本郷" name="radio1" id="hongou" />
		<lavel for="mazime2">本郷　</lavel>
		<input type="radio" value="任意" name="radio1" id="any" checked="true" />
		<lavel for="mazime3">どちらでも　</lavel>
		</td>
	</tr>
	<tr>
	<th scope="row">飲み会</th>
		<td>
		←少ない
		<input type="radio" value="1  " name="radio3" id="nomi1" />
		<lavel for="nomi1">1</lavel>
		<input type="radio" value="2  " name="radio3" id="nomi2" />
		<lavel for="nomi2">2</lavel>
		<input type="radio" value="3  " name="radio3" id="nomi3" checked="true" />
		<lavel for="nomi3">3</lavel>
		<input type="radio" value="4  " name="radio3" id="nomi4" />
		<lavel for="nomi4">4</lavel>
		<input type="radio" value="5  " name="radio3" id="nomi5" />
		<lavel for="nomi5">5</lavel>
		→多い
		<br>
		<input type="checkbox" name="nochoice1" id="nochoice1" value="1" checked="true" />
		<lavel for="activity81">飲みを検索条件から外す　</lavel>
		</td>
	</tr>
	<tr>
	<th scope="row">真面目さ</th>
		<td>
		←楽しい
		<input type="radio" value="1  " name="radio4" id="mazime1" />
		<lavel for="mazime1">1</lavel>
		<input type="radio" value="2  " name="radio4" id="mazime2" />
		<lavel for="mazime2">2</lavel>
		<input type="radio" value="3  " name="radio4" id="mazime3" checked="true" />
		<lavel for="mazime3">3</lavel>
		<input type="radio" value="4  " name="radio4" id="mazime4" />
		<lavel for="mazime4">4</lavel>
		<input type="radio" value="5  " name="radio4" id="mazime5" />
		<lavel for="mazime5">5</lavel>
		→ガチ
		<br>
		<input type="checkbox" name="nochoice2" id="nochoice2" value="1" checked="true" />
		<lavel for="activity81">真面目さを検索条件から外す　</lavel>
		</td>
	</tr>
	</tbody>
	</table>
	<input type="submit" value="送信" />
	<br>
	<br>
</form>

<section id="lunch">


<h3 class="mb1em">ランチメニュー</h3>

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
<h4><font color =#0099ff>サークル名をクリックするとそのサークルのホームページに移動できます</font></h4>
<br>
<table rules="all" border="3" bordercolor="#282828">
<tr>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">サークル名</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">TwitterID</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">活動内容</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">活動日</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">活動場所</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">構成人員</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">男性人数</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">女性人数</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">活動費</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">飲み</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">真面目さ</font></th>
</tr>
<?php foreach ($data as $datum): ?>
	<?php $act2=$datum['Circle']['activity']; ?>
	<?php
	$day =array(
		$datum['Circle']['day1'],
		$datum['Circle']['day2'],
		$datum['Circle']['day3'],
		$datum['Circle']['day4'],
		$datum['Circle']['day5'],
		$datum['Circle']['day6'],
		$datum['Circle']['day7']
	);
	$day2=array(
		"月",
		"火",
		"水",
		"木",
		"金",
		"土",
		"日"
	);
	$c=0;
	?>
	<tr>
		<td bgcolor="#bcfffe">
			<?php if($datum['Circle']['url']): ?>
				<a href="<?php echo $datum['Circle']['url']; ?>"　target="_blank">
					<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
				</a>
			<?php else: ?>
				<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
			<?php endif; ?>
		</td>
		<td bgcolor="#bcfffe">
			<?php 
				$string = "https://twitter.com/";	
				$string .= $datum['Circle']['twitterid'];	
			?>	
			<a href= <?php echo $string; ?> class="twitter-follow-button" data-show-count="false" data-width = "200px">
				Follow 
				<?php echo $datum['Circle']['twitterid']; ?>
			</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
			</script>
		</td>
		<td bgcolor="#bcfffe"><?php echo $act[$act2]; ?></td>
		<td bgcolor="#bcfffe">
		<?php
			for ($i=0;$i<7;$i++):
				if ($day[$i]=="1"):
					if ($c==0):
						echo $day2[$i];
						$c=$c+1;
					else:
						echo ",";
						echo $day2[$i];
					endif;
				endif;
			endfor;
		?>
		</td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['place']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['intercollege']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['man']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['woman']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['cost']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['nomi']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['mazime']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<br></br>	
<h5><font color =#0099ff>結果をツイートして友達を誘おう</font></h5>	
<?php $string = "";	
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
<!--<?php print_r($count_data); ?> -->


<?php foreach ($data as $datum): ?>

<section class="list">
<h3> <!--サークルの名前-->
<a href="../Circles/circle_id/<?php echo $datum['Circle']['id']; ?>">
	<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
</a>
</h3>
	<?php if($datum['Circle']['photo_name'] != ""): ?>
	<?php var_dump($datum['Circle']['photo_name']); ?>
		<figure><img src="../img/".$datum['Circle']['photo_name'] width="280" height="210" alt="" /></figure>
	<?php else: ?>
		<figure><img src="../img/sample_photo1.jpg" width="280" height="210" alt="" /></figure>
	<?php endif; ?>
<h4><!--サークルの名前-->
	<a href="../Circles/circle_id/<?php echo $datum['Circle']['id']; ?>">
		<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
	</a>
	<!--
	<?php if($datum['Circle']['url']): ?>
		<a href="<?php echo $datum['Circle']['url']; ?>"　target="_blank">
		<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
		</a>
	<?php else: ?>
		<font color =#0099ff><?php echo $datum['Circle']['circle_name']; ?></font>
	<?php endif; ?>
	-->
	<?php 
		$string = "https://twitter.com/";	
		$string .= $datum['Circle']['twitterid'];	
	?>	
		<a href= <?php echo $string; ?> class="twitter-follow-button" data-show-count="false" data-width = "200px">
			Follow 
		<?php echo $datum['Circle']['twitterid']; ?>
		</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
		</script>
	
</h4>
<p>
<!--table type03を定義しておく?-->
<table class = "type03">
	<tbody>
	<tr>
		<th scope="row">活動内容</th>
		<td><?php echo $act[$act2]; ?></td>
	</tr>
	<tr>
		<th scope="row">ひとこと</th>
		<td><?php echo $datum['Circle']['pr']; ?></td>
	</tr>

	<tr>
		<th scope="row">場所</th>
		<td><?php echo $datum['Circle']['place']; ?> : <?php echo $datum['Circle']['placetext']; ?></td>
	</tr>
	<tr>
		<th scope="row">基本曜日</th>
		<td>
		<?php
			for ($i=0;$i<7;$i++):
				if ($day[$i]=="1"):
					if ($c==0):
						echo $day2[$i];
						$c=$c+1;
					else:
						echo ",";
						echo $day2[$i];
					endif;
				endif;
			endfor;
		?>
		</td>
	</tr>
	</tbody>
</table>
</p>


<img src="../img/icon_osusume.png" width="90" height="60" alt="おすすめ" class="icon"></p>
</section>


<?php endforeach; ?>
<!-- ここで　if文に対応した部分が表示される-->
<?php endif; ?>


<section class="list">
<figure><img src="../img/sample_photo1.jpg" width="280" height="210" alt="" /></figure>
<h4>ランチプレート　1,300円</h4>
<p>「おすすめ」マークはhtml内に画像として配置し、class=&quot;icon&quot;と指定すればボックス右上に表示されます。他に好きなアイコンを作ってclass指定してもOK。
<img src="../img/icon_osusume.png" width="90" height="60" alt="おすすめ" class="icon"></p>
</section>

<section class="list">
<figure><img src="../img/sample_photo1.jpg" width="280" height="210" alt="" /></figure>
<h4>ランチプレート　1,300円</h4>
<p>左の「おすすめ」マーク同様に、画像をhtml側に直接置き、class=&quot;icon&quot;を指定して下さい。
<img src="../img/icon_ninki.png" width="90" height="60" alt="人気" class="icon"></p>
</section>

<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</section>
<!--/lunch-->

<section id="course">

<h3 class="mb1em">コースメニュー</h3>

<section class="list">
<figure><img src="../img/sample_photo2.jpg" width="280" height="210" alt="" /></figure>
<h4>コース　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<section class="list">
<figure><img src="../img/sample_photo2.jpg" width="280" height="210" alt="" /></figure>
<h4>コーA　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</section>
<!--/course-->

<section id="single">

<h3 class="mb1em">単品メニュー</h3>

<section class="list">
<figure><img src="../img/sample_photo3.jpg" width="280" height="210" alt="" /></figure>
<h4>サンプル　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<section class="list">
<figure><img src="../img/sample_photo3.jpg" width="280" height="210" alt="" /></figure>
<h4>サンプル　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</section>
<!--/single-->

<section id="drink">

<h3 class="mb1em">ドリンクメニュー</h3>

<section class="list">
<figure><img src="../img/sample_photo4.jpg" width="280" height="210" alt="" /></figure>
<h4>ドリンク　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<section class="list">
<figure><img src="../img/sample_photo4.jpg" width="280" height="210" alt="" /></figure>
<h4>ドリンク　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</section>
<!--/drink-->

<section id="desert">

<h3 class="mb1em">デザートメニュー</h3>

<section class="list">
<figure><img src="../img/sample_photo5.jpg" width="280" height="210" alt="" /></figure>
<h4>デザート　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<section class="list">
<figure><img src="../img/sample_photo5.jpg" width="280" height="210" alt="" /></figure>
<h4>デザート　1,300円</h4>
<p>ここに説明を入れます。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。</p>
</section>

<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</section>
<!--/desert-->

</div>
