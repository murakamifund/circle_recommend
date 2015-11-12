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
	種目 (選択必須)<br>
	インドア　全選択<br>
	<input type="checkbox" name="check2" id="activity2" value="1" />
	<lavel for="activity2">合唱</lavel>
	<br>
	アウトドア　全選択<br>
	<input type="checkbox" name="check1" id="activity1" value="1" />
	<lavel for="activity1">テニス</lavel>
	<input type="checkbox" name="check3" id="activity3" value="1" />
	<lavel for="activity3">卓球</lavel>
	<input type="checkbox" name="check4" id="activity4" value="1" />
	<lavel for="activity4">サッカー</lavel>
	<br>
	その他<br>
	<input type="checkbox" name="check5" id="activity5" value="1" />
	<lavel for="activity5">その他</lavel>
	<br>
	<table class = "type01">
	<tbody>
	<tr>
	<th scope="row">活動場所</th>
		<td><input type="radio" value="0" name="radio1" id="komaba" />
		<lavel for="komaba">駒場</lavel>
		<input type="radio" value="1" name="radio1" id="honngou" />
		<lavel for="honngou">本郷</lavel>
		<input type="radio" value="2" name="radio1" id="uninterested1" checked="true" />
		<lavel for="uninterested1">どこでも</lavel>
		</td>
	</tr>
	<tr>
	<th scope="row">構成</th>
		<td><input type="radio" value="0" name="radio2" id="gakunai" />
		<lavel for="gakunai">学内</lavel>
		<input type="radio" value="1" name="radio2" id="inter" />
		<lavel for="inter">インカレ</lavel>
		<input type="radio" value="2" name="radio2" id="uninterested2" checked="true"  />
		<lavel for="uninterested2">どちらでも</lavel>
		</td>
	</tr>
	<tr>
	<th scope="row">人数</th>
		<td>総勢<input type="text" name="all" value="0"/>人以上<br>
		男性<input type="text" name="man" value="0"/>人以上<br>
		女性<input type="text" name="woman" value="0" />人以上
		</td>
	</tr>
	<tr>
	<th scope="row">活動費</th>
		<td><input type="text" name="cost" value="50000" />円以下
		</td>
	</tr>
	<tr>
	<th scope="row">飲み</th>
		<td>←ゆるい
		<input type="radio" value="1" name="radio3" id="nomi1" />
		<lavel for="nomi1">1</lavel>
		<input type="radio" value="2" name="radio3" id="nomi2" />
		<lavel for="nomi2">2</lavel>
		<input type="radio" value="3" name="radio3" id="nomi3" checked="true" />
		<lavel for="nomi3">3</lavel>
		<input type="radio" value="4" name="radio3" id="nomi4" />
		<lavel for="nomi4">4</lavel>
		<input type="radio" value="5" name="radio3" id="nomi5" />
		<lavel for="nomi5">5</lavel>
		→激しい
		</td>
	</tr>
	<tr>
	<th scope="row">真面目さ</th>
		<td>←ワイワイ
		<input type="radio" value="1" name="radio4" id="mazime1" />
		<lavel for="mazime1">1</lavel>
		<input type="radio" value="2" name="radio4" id="mazime2" />
		<lavel for="mazime2">2</lavel>
		<input type="radio" value="3" name="radio4" id="mazime3" checked="true" />
		<lavel for="mazime3">3</lavel>
		<input type="radio" value="4" name="radio4" id="mazime4" />
		<lavel for="mazime4">4</lavel>
		<input type="radio" value="5" name="radio4" id="mazime5" />
		<lavel for="mazime5">5</lavel>
		→ガチ
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
$act=array(
	"テニス",
	"合唱",
	"卓球",
	"サッカー",
	"その他",
);
$d=0;	
if($this->request->data){	
	for($i=0;$i<5;$i++):	
		if($activity[$i]=="On"):	
			$d=$d+1;	
		endif;	
	endfor;	
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
