<h2>検索</h2>

<h1>サークルを探そう</h1>
<h1>条件を入力すればおすすめのサークルを表示します</h1>
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
	活動場所<br>
	<input type="radio" value="0" name="radio1" id="komaba" />
	<lavel for="komaba">駒場</lavel>
	<input type="radio" value="1" name="radio1" id="honngou" />
	<lavel for="honngou">本郷</lavel>
	<input type="radio" value="2" name="radio1" id="uninterested1" checked="true" />
	<lavel for="uninterested1">どこでも</lavel>
	<br>
	構成人員<br>
	<input type="radio" value="0" name="radio2" id="gakunai" />
	<lavel for="gakunai">学内</lavel>
	<input type="radio" value="1" name="radio2" id="inter" />
	<lavel for="inter">インカレ</lavel>
	<input type="radio" value="2" name="radio2" id="uninterested2" checked="true"  />
	<lavel for="uninterested2">どちらでも</lavel>
	<br>
	総人数<br><input type="text" name="all" value="0"/>人以上<br>
	男性<br><input type="text" name="man" value="0"/>人以上<br>
	女性<br><input type="text" name="woman" value="0" />人以上<br>
	活動費<br><input type="text" name="cost" value="50000" />円以下<br>
	飲み<br>
	←ゆるい
	<input type="radio" value="1" name="radio3" id="nomi1" />
	<lavel for="nomi1">１</lavel>
	<input type="radio" value="2" name="radio3" id="nomi2" />
	<lavel for="nomi2">２</lavel>
	<input type="radio" value="3" name="radio3" id="nomi3" checked="true" />
	<lavel for="nomi3">３</lavel>
	<input type="radio" value="4" name="radio3" id="nomi4" />
	<lavel for="nomi4">４</lavel>
	<input type="radio" value="5" name="radio3" id="nomi5" />
	<lavel for="nomi5">５</lavel>
	→激しい
	<br>
	真面目さ<br>
	←ワイワイ
	<input type="radio" value="1" name="radio4" id="mazime1" />
	<lavel for="mazime1">１</lavel>
	<input type="radio" value="2" name="radio4" id="mazime2" />
	<lavel for="mazime2">２</lavel>
	<input type="radio" value="3" name="radio4" id="mazime3" checked="true" />
	<lavel for="mazime3">３</lavel>
	<input type="radio" value="4" name="radio4" id="mazime4" />
	<lavel for="mazime4">４</lavel>
	<input type="radio" value="5" name="radio4" id="mazime5" />
	<lavel for="mazime5">５</lavel>
	→ガチ
	<br>
	<input type="submit" value="送信" />
	<br>
	<br>
</form>
<p class="pagetop"><a href="#">↑ PAGE TOP</a></p>

</div>
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
	<th width="100" bgcolor="#45b887"><font color="#ffffff">総人数</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">男性人数</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">女性人数</font></th>
	<th width="100" bgcolor="#45b887"><font color="#ffffff">活動費</font></th>
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
		<td bgcolor="#bcfffe"><a href="<?php echo $datum['Circle']['url']; ?>"　target="_blank"><font color =#0099ff><?php echo $datum['Circle']['name']; ?></font></a></td>
		<td bgcolor="#bcfffe"><?php $string = "https://twitter.com/";	
$string .= $datum['Circle']['circle_name'];	
?>	
<a href= <?php echo $string; ?> class="twitter-follow-button" data-show-count="false" data-width = "200px">Follow <?php echo $datum['Circle']['username']; ?></a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td>
		<td bgcolor="#bcfffe"><?php echo $act[$act2]; ?></td>
		<td bgcolor="#bcfffe"><?php
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
		?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['place']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['intercollege']; ?></td>
		<td bgcolor="#bcfffe"><?php echo $datum['Circle']['all']; ?></td>
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
$string .= $datum['Circle']['name'];	
if (count($data) != $i){	
$string .= ",";	
}	
$i = $i + 1;	
endforeach ?>	
<a href = "https://twitter.com/share" data-hashtags= <?php echo $string; ?> data-text = 'このサークルの新歓に行く人は一緒に行こう！' data-url = '' data-size = 'large' class="twitter-hashtag-button" >Tweet #circlerecommend</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>	
<br></br>
<!--<?php print_r($count_data); ?> -->
<h1>新歓日程カレンダー (<?php echo $year; ?>年)</h1>
<h1>３月</h1>
<table rules="all" border="3" bordercolor="#282828">
<tr>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">日</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">月</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">火</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">水</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">木</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">金</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">土</font></th>
</tr>

<tr>
	<?php for($i=1;$i<8;$i++): ?>
		<?php if($i-$s3>0): ?>
			<td bgcolor="#bcfffe">
				<?php echo $i-$s3; ?><br>
				<?php
				$n=0;
				foreach ($data as $datum):
					$nittei3=array(
						$datum['Circle']['schedule301'],
						$datum['Circle']['schedule302'],
						$datum['Circle']['schedule303'],
						$datum['Circle']['schedule304'],
						$datum['Circle']['schedule305'],
						$datum['Circle']['schedule306'],
						$datum['Circle']['schedule307'],
						$datum['Circle']['schedule308'],
						$datum['Circle']['schedule309'],
						$datum['Circle']['schedule310'],
						$datum['Circle']['schedule311'],
						$datum['Circle']['schedule312'],
						$datum['Circle']['schedule313'],
						$datum['Circle']['schedule314'],
						$datum['Circle']['schedule315'],
						$datum['Circle']['schedule316'],
						$datum['Circle']['schedule317'],
						$datum['Circle']['schedule318'],
						$datum['Circle']['schedule319'],
						$datum['Circle']['schedule320'],
						$datum['Circle']['schedule321'],
						$datum['Circle']['schedule322'],
						$datum['Circle']['schedule323'],
						$datum['Circle']['schedule324'],
						$datum['Circle']['schedule325'],
						$datum['Circle']['schedule326'],
						$datum['Circle']['schedule327'],
						$datum['Circle']['schedule328'],
						$datum['Circle']['schedule329'],
						$datum['Circle']['schedule330'],
						$datum['Circle']['schedule331'],
					);
					?>
					<?php if($nittei3[$i-$s3-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s3<1): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=8;$i<15;$i++): ?>
		<td bgcolor="#bcfffe">
			<?php echo $i-$s3; ?><br>
			<?php
			$n=0;
			foreach ($data as $datum):
				$nittei3=array(
					$datum['Circle']['schedule301'],
					$datum['Circle']['schedule302'],
					$datum['Circle']['schedule303'],
					$datum['Circle']['schedule304'],
					$datum['Circle']['schedule305'],
					$datum['Circle']['schedule306'],
					$datum['Circle']['schedule307'],
					$datum['Circle']['schedule308'],
					$datum['Circle']['schedule309'],
					$datum['Circle']['schedule310'],
					$datum['Circle']['schedule311'],
					$datum['Circle']['schedule312'],
					$datum['Circle']['schedule313'],
					$datum['Circle']['schedule314'],
					$datum['Circle']['schedule315'],
					$datum['Circle']['schedule316'],
					$datum['Circle']['schedule317'],
					$datum['Circle']['schedule318'],
					$datum['Circle']['schedule319'],
					$datum['Circle']['schedule320'],
					$datum['Circle']['schedule321'],
					$datum['Circle']['schedule322'],
					$datum['Circle']['schedule323'],
					$datum['Circle']['schedule324'],
					$datum['Circle']['schedule325'],
					$datum['Circle']['schedule326'],
					$datum['Circle']['schedule327'],
					$datum['Circle']['schedule328'],
					$datum['Circle']['schedule329'],
					$datum['Circle']['schedule330'],
					$datum['Circle']['schedule331'],
				);
				?>
				<?php if($nittei3[$i-$s3-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=15;$i<22;$i++): ?>
		<td bgcolor="#bcfffe">
			<?php echo $i-$s3; ?><br>
			<?php
			$n=0;
			foreach ($data as $datum):
				$nittei3=array(
					$datum['Circle']['schedule301'],
					$datum['Circle']['schedule302'],
					$datum['Circle']['schedule303'],
					$datum['Circle']['schedule304'],
					$datum['Circle']['schedule305'],
					$datum['Circle']['schedule306'],
					$datum['Circle']['schedule307'],
					$datum['Circle']['schedule308'],
					$datum['Circle']['schedule309'],
					$datum['Circle']['schedule310'],
					$datum['Circle']['schedule311'],
					$datum['Circle']['schedule312'],
					$datum['Circle']['schedule313'],
					$datum['Circle']['schedule314'],
					$datum['Circle']['schedule315'],
					$datum['Circle']['schedule316'],
					$datum['Circle']['schedule317'],
					$datum['Circle']['schedule318'],
					$datum['Circle']['schedule319'],
					$datum['Circle']['schedule320'],
					$datum['Circle']['schedule321'],
					$datum['Circle']['schedule322'],
					$datum['Circle']['schedule323'],
					$datum['Circle']['schedule324'],
					$datum['Circle']['schedule325'],
					$datum['Circle']['schedule326'],
					$datum['Circle']['schedule327'],
					$datum['Circle']['schedule328'],
					$datum['Circle']['schedule329'],
					$datum['Circle']['schedule330'],
					$datum['Circle']['schedule331'],
				);
				?>
				<?php if($nittei3[$i-$s3-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=22;$i<29;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s3; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei3=array(
					$datum['Circle']['schedule301'],
					$datum['Circle']['schedule302'],
					$datum['Circle']['schedule303'],
					$datum['Circle']['schedule304'],
					$datum['Circle']['schedule305'],
					$datum['Circle']['schedule306'],
					$datum['Circle']['schedule307'],
					$datum['Circle']['schedule308'],
					$datum['Circle']['schedule309'],
					$datum['Circle']['schedule310'],
					$datum['Circle']['schedule311'],
					$datum['Circle']['schedule312'],
					$datum['Circle']['schedule313'],
					$datum['Circle']['schedule314'],
					$datum['Circle']['schedule315'],
					$datum['Circle']['schedule316'],
					$datum['Circle']['schedule317'],
					$datum['Circle']['schedule318'],
					$datum['Circle']['schedule319'],
					$datum['Circle']['schedule320'],
					$datum['Circle']['schedule321'],
					$datum['Circle']['schedule322'],
					$datum['Circle']['schedule323'],
					$datum['Circle']['schedule324'],
					$datum['Circle']['schedule325'],
					$datum['Circle']['schedule326'],
					$datum['Circle']['schedule327'],
					$datum['Circle']['schedule328'],
					$datum['Circle']['schedule329'],
					$datum['Circle']['schedule330'],
					$datum['Circle']['schedule331'],
				);
				?>
				<?php if($nittei3[$i-$s3-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=29;$i<36;$i++): ?>
		<?php if($i-$s3<32): ?>
			<td bgcolor="#bcfffe"><?php
				echo $i-$s3;
				$n=0;
				foreach ($data as $datum):
					$nittei3=array(
						$datum['Circle']['schedule301'],
						$datum['Circle']['schedule302'],
						$datum['Circle']['schedule303'],
						$datum['Circle']['schedule304'],
						$datum['Circle']['schedule305'],
						$datum['Circle']['schedule306'],
						$datum['Circle']['schedule307'],
						$datum['Circle']['schedule308'],
						$datum['Circle']['schedule309'],
						$datum['Circle']['schedule310'],
						$datum['Circle']['schedule311'],
						$datum['Circle']['schedule312'],
						$datum['Circle']['schedule313'],
						$datum['Circle']['schedule314'],
						$datum['Circle']['schedule315'],
						$datum['Circle']['schedule316'],
						$datum['Circle']['schedule317'],
						$datum['Circle']['schedule318'],
						$datum['Circle']['schedule319'],
						$datum['Circle']['schedule320'],
						$datum['Circle']['schedule321'],
						$datum['Circle']['schedule322'],
						$datum['Circle']['schedule323'],
						$datum['Circle']['schedule324'],
						$datum['Circle']['schedule325'],
						$datum['Circle']['schedule326'],
						$datum['Circle']['schedule327'],
						$datum['Circle']['schedule328'],
						$datum['Circle']['schedule329'],
						$datum['Circle']['schedule330'],
						$datum['Circle']['schedule331'],
					);
					?>
					<?php if($nittei3[$i-$s3-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s3>31): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=36;$i<43;$i++): ?>
		<?php if($i-$s3<32): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s3; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei3=array(
						$datum['Circle']['schedule301'],
						$datum['Circle']['schedule302'],
						$datum['Circle']['schedule303'],
						$datum['Circle']['schedule304'],
						$datum['Circle']['schedule305'],
						$datum['Circle']['schedule306'],
						$datum['Circle']['schedule307'],
						$datum['Circle']['schedule308'],
						$datum['Circle']['schedule309'],
						$datum['Circle']['schedule310'],
						$datum['Circle']['schedule311'],
						$datum['Circle']['schedule312'],
						$datum['Circle']['schedule313'],
						$datum['Circle']['schedule314'],
						$datum['Circle']['schedule315'],
						$datum['Circle']['schedule316'],
						$datum['Circle']['schedule317'],
						$datum['Circle']['schedule318'],
						$datum['Circle']['schedule319'],
						$datum['Circle']['schedule320'],
						$datum['Circle']['schedule321'],
						$datum['Circle']['schedule322'],
						$datum['Circle']['schedule323'],
						$datum['Circle']['schedule324'],
						$datum['Circle']['schedule325'],
						$datum['Circle']['schedule326'],
						$datum['Circle']['schedule327'],
						$datum['Circle']['schedule328'],
						$datum['Circle']['schedule329'],
						$datum['Circle']['schedule330'],
						$datum['Circle']['schedule331'],
					);
					?>
					<?php if($nittei3[$i-$s3-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s3>31): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
</table>

<h1>４月</h1>
<table rules="all" border="3" bordercolor="#282828">
<tr>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">日</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">月</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">火</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">水</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">木</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">金</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">土</font></th>
</tr>

<tr>
	<?php for($i=1;$i<8;$i++): ?>
		<?php if($i-$s4>0): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s4; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei4=array(
						$datum['Circle']['schedule401'],
						$datum['Circle']['schedule402'],
						$datum['Circle']['schedule403'],
						$datum['Circle']['schedule404'],
						$datum['Circle']['schedule405'],
						$datum['Circle']['schedule406'],
						$datum['Circle']['schedule407'],
						$datum['Circle']['schedule408'],
						$datum['Circle']['schedule409'],
						$datum['Circle']['schedule410'],
						$datum['Circle']['schedule411'],
						$datum['Circle']['schedule412'],
						$datum['Circle']['schedule413'],
						$datum['Circle']['schedule414'],
						$datum['Circle']['schedule415'],
						$datum['Circle']['schedule416'],
						$datum['Circle']['schedule417'],
						$datum['Circle']['schedule418'],
						$datum['Circle']['schedule419'],
						$datum['Circle']['schedule420'],
						$datum['Circle']['schedule421'],
						$datum['Circle']['schedule422'],
						$datum['Circle']['schedule423'],
						$datum['Circle']['schedule424'],
						$datum['Circle']['schedule425'],
						$datum['Circle']['schedule426'],
						$datum['Circle']['schedule427'],
						$datum['Circle']['schedule428'],
						$datum['Circle']['schedule429'],
						$datum['Circle']['schedule430'],
					);
					?>
					<?php if($nittei4[$i-$s4-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s4<1): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=8;$i<15;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s4; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei4=array(
					$datum['Circle']['schedule401'],
					$datum['Circle']['schedule402'],
					$datum['Circle']['schedule403'],
					$datum['Circle']['schedule404'],
					$datum['Circle']['schedule405'],
					$datum['Circle']['schedule406'],
					$datum['Circle']['schedule407'],
					$datum['Circle']['schedule408'],
					$datum['Circle']['schedule409'],
					$datum['Circle']['schedule410'],
					$datum['Circle']['schedule411'],
					$datum['Circle']['schedule412'],
					$datum['Circle']['schedule413'],
					$datum['Circle']['schedule414'],
					$datum['Circle']['schedule415'],
					$datum['Circle']['schedule416'],
					$datum['Circle']['schedule417'],
					$datum['Circle']['schedule418'],
					$datum['Circle']['schedule419'],
					$datum['Circle']['schedule420'],
					$datum['Circle']['schedule421'],
					$datum['Circle']['schedule422'],
					$datum['Circle']['schedule423'],
					$datum['Circle']['schedule424'],
					$datum['Circle']['schedule425'],
					$datum['Circle']['schedule426'],
					$datum['Circle']['schedule427'],
					$datum['Circle']['schedule428'],
					$datum['Circle']['schedule429'],
					$datum['Circle']['schedule430'],
				);
				?>
				<?php if($nittei4[$i-$s4-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=15;$i<22;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s4; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei4=array(
					$datum['Circle']['schedule401'],
					$datum['Circle']['schedule402'],
					$datum['Circle']['schedule403'],
					$datum['Circle']['schedule404'],
					$datum['Circle']['schedule405'],
					$datum['Circle']['schedule406'],
					$datum['Circle']['schedule407'],
					$datum['Circle']['schedule408'],
					$datum['Circle']['schedule409'],
					$datum['Circle']['schedule410'],
					$datum['Circle']['schedule411'],
					$datum['Circle']['schedule412'],
					$datum['Circle']['schedule413'],
					$datum['Circle']['schedule414'],
					$datum['Circle']['schedule415'],
					$datum['Circle']['schedule416'],
					$datum['Circle']['schedule417'],
					$datum['Circle']['schedule418'],
					$datum['Circle']['schedule419'],
					$datum['Circle']['schedule420'],
					$datum['Circle']['schedule421'],
					$datum['Circle']['schedule422'],
					$datum['Circle']['schedule423'],
					$datum['Circle']['schedule424'],
					$datum['Circle']['schedule425'],
					$datum['Circle']['schedule426'],
					$datum['Circle']['schedule427'],
					$datum['Circle']['schedule428'],
					$datum['Circle']['schedule429'],
					$datum['Circle']['schedule430'],
				);
				?>
				<?php if($nittei4[$i-$s4-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=22;$i<29;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s4; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei4=array(
					$datum['Circle']['schedule401'],
					$datum['Circle']['schedule402'],
					$datum['Circle']['schedule403'],
					$datum['Circle']['schedule404'],
					$datum['Circle']['schedule405'],
					$datum['Circle']['schedule406'],
					$datum['Circle']['schedule407'],
					$datum['Circle']['schedule408'],
					$datum['Circle']['schedule409'],
					$datum['Circle']['schedule410'],
					$datum['Circle']['schedule411'],
					$datum['Circle']['schedule412'],
					$datum['Circle']['schedule413'],
					$datum['Circle']['schedule414'],
					$datum['Circle']['schedule415'],
					$datum['Circle']['schedule416'],
					$datum['Circle']['schedule417'],
					$datum['Circle']['schedule418'],
					$datum['Circle']['schedule419'],
					$datum['Circle']['schedule420'],
					$datum['Circle']['schedule421'],
					$datum['Circle']['schedule422'],
					$datum['Circle']['schedule423'],
					$datum['Circle']['schedule424'],
					$datum['Circle']['schedule425'],
					$datum['Circle']['schedule426'],
					$datum['Circle']['schedule427'],
					$datum['Circle']['schedule428'],
					$datum['Circle']['schedule429'],
					$datum['Circle']['schedule430'],
				);
				?>
				<?php if($nittei4[$i-$s4-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=29;$i<36;$i++): ?>
		<?php if($i-$s4<31): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s4; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei4=array(
						$datum['Circle']['schedule401'],
						$datum['Circle']['schedule402'],
						$datum['Circle']['schedule403'],
						$datum['Circle']['schedule404'],
						$datum['Circle']['schedule405'],
						$datum['Circle']['schedule406'],
						$datum['Circle']['schedule407'],
						$datum['Circle']['schedule408'],
						$datum['Circle']['schedule409'],
						$datum['Circle']['schedule410'],
						$datum['Circle']['schedule411'],
						$datum['Circle']['schedule412'],
						$datum['Circle']['schedule413'],
						$datum['Circle']['schedule414'],
						$datum['Circle']['schedule415'],
						$datum['Circle']['schedule416'],
						$datum['Circle']['schedule417'],
						$datum['Circle']['schedule418'],
						$datum['Circle']['schedule419'],
						$datum['Circle']['schedule420'],
						$datum['Circle']['schedule421'],
						$datum['Circle']['schedule422'],
						$datum['Circle']['schedule423'],
						$datum['Circle']['schedule424'],
						$datum['Circle']['schedule425'],
						$datum['Circle']['schedule426'],
						$datum['Circle']['schedule427'],
						$datum['Circle']['schedule428'],
						$datum['Circle']['schedule429'],
						$datum['Circle']['schedule430'],
					);
					?>
					<?php if($nittei4[$i-$s4-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s4>30): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=36;$i<43;$i++): ?>
		<?php if($i-$s4<31): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s4; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei4=array(
						$datum['Circle']['schedule401'],
						$datum['Circle']['schedule402'],
						$datum['Circle']['schedule403'],
						$datum['Circle']['schedule404'],
						$datum['Circle']['schedule405'],
						$datum['Circle']['schedule406'],
						$datum['Circle']['schedule407'],
						$datum['Circle']['schedule408'],
						$datum['Circle']['schedule409'],
						$datum['Circle']['schedule410'],
						$datum['Circle']['schedule411'],
						$datum['Circle']['schedule412'],
						$datum['Circle']['schedule413'],
						$datum['Circle']['schedule414'],
						$datum['Circle']['schedule415'],
						$datum['Circle']['schedule416'],
						$datum['Circle']['schedule417'],
						$datum['Circle']['schedule418'],
						$datum['Circle']['schedule419'],
						$datum['Circle']['schedule420'],
						$datum['Circle']['schedule421'],
						$datum['Circle']['schedule422'],
						$datum['Circle']['schedule423'],
						$datum['Circle']['schedule424'],
						$datum['Circle']['schedule425'],
						$datum['Circle']['schedule426'],
						$datum['Circle']['schedule427'],
						$datum['Circle']['schedule428'],
						$datum['Circle']['schedule429'],
						$datum['Circle']['schedule430'],
					);
					?>
					<?php if($nittei4[$i-$s4-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s4>30): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
</table>

<h1>５月</h1>
<table rules="all" border="3" bordercolor="#282828">
<tr>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">日</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">月</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">火</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">水</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">木</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">金</font></th>
	<th width="200" bgcolor="#45b887"><font color="#ffffff">土</font></th>
</tr>

<tr>
	<?php for($i=1;$i<8;$i++): ?>
		<?php if($i-$s5>0): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s5; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei5=array(
						$datum['Circle']['schedule501'],
						$datum['Circle']['schedule502'],
						$datum['Circle']['schedule503'],
						$datum['Circle']['schedule504'],
						$datum['Circle']['schedule505'],
						$datum['Circle']['schedule506'],
						$datum['Circle']['schedule507'],
						$datum['Circle']['schedule508'],
						$datum['Circle']['schedule509'],
						$datum['Circle']['schedule510'],
						$datum['Circle']['schedule511'],
						$datum['Circle']['schedule512'],
						$datum['Circle']['schedule513'],
						$datum['Circle']['schedule514'],
						$datum['Circle']['schedule515'],
						$datum['Circle']['schedule516'],
						$datum['Circle']['schedule517'],
						$datum['Circle']['schedule518'],
						$datum['Circle']['schedule519'],
						$datum['Circle']['schedule520'],
						$datum['Circle']['schedule521'],
						$datum['Circle']['schedule522'],
						$datum['Circle']['schedule523'],
						$datum['Circle']['schedule524'],
						$datum['Circle']['schedule525'],
						$datum['Circle']['schedule526'],
						$datum['Circle']['schedule527'],
						$datum['Circle']['schedule528'],
						$datum['Circle']['schedule529'],
						$datum['Circle']['schedule530'],
						$datum['Circle']['schedule531'],
					);
					?>
					<?php if($nittei5[$i-$s5-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s5<1): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=8;$i<15;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s5; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei5=array(
					$datum['Circle']['schedule501'],
					$datum['Circle']['schedule502'],
					$datum['Circle']['schedule503'],
					$datum['Circle']['schedule504'],
					$datum['Circle']['schedule505'],
					$datum['Circle']['schedule506'],
					$datum['Circle']['schedule507'],
					$datum['Circle']['schedule508'],
					$datum['Circle']['schedule509'],
					$datum['Circle']['schedule510'],
					$datum['Circle']['schedule511'],
					$datum['Circle']['schedule512'],
					$datum['Circle']['schedule513'],
					$datum['Circle']['schedule514'],
					$datum['Circle']['schedule515'],
					$datum['Circle']['schedule516'],
					$datum['Circle']['schedule517'],
					$datum['Circle']['schedule518'],
					$datum['Circle']['schedule519'],
					$datum['Circle']['schedule520'],
					$datum['Circle']['schedule521'],
					$datum['Circle']['schedule522'],
					$datum['Circle']['schedule523'],
					$datum['Circle']['schedule524'],
					$datum['Circle']['schedule525'],
					$datum['Circle']['schedule526'],
					$datum['Circle']['schedule527'],
					$datum['Circle']['schedule528'],
					$datum['Circle']['schedule529'],
					$datum['Circle']['schedule530'],
					$datum['Circle']['schedule531'],
				);
				?>
				<?php if($nittei5[$i-$s5-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=15;$i<22;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s5; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei5=array(
					$datum['Circle']['schedule501'],
					$datum['Circle']['schedule502'],
					$datum['Circle']['schedule503'],
					$datum['Circle']['schedule504'],
					$datum['Circle']['schedule505'],
					$datum['Circle']['schedule506'],
					$datum['Circle']['schedule507'],
					$datum['Circle']['schedule508'],
					$datum['Circle']['schedule509'],
					$datum['Circle']['schedule510'],
					$datum['Circle']['schedule511'],
					$datum['Circle']['schedule512'],
					$datum['Circle']['schedule513'],
					$datum['Circle']['schedule514'],
					$datum['Circle']['schedule515'],
					$datum['Circle']['schedule516'],
					$datum['Circle']['schedule517'],
					$datum['Circle']['schedule518'],
					$datum['Circle']['schedule519'],
					$datum['Circle']['schedule520'],
					$datum['Circle']['schedule521'],
					$datum['Circle']['schedule522'],
					$datum['Circle']['schedule523'],
					$datum['Circle']['schedule524'],
					$datum['Circle']['schedule525'],
					$datum['Circle']['schedule526'],
					$datum['Circle']['schedule527'],
					$datum['Circle']['schedule528'],
					$datum['Circle']['schedule529'],
					$datum['Circle']['schedule530'],
					$datum['Circle']['schedule531'],
				);
				?>
				<?php if($nittei5[$i-$s5-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=22;$i<29;$i++): ?>
		<td bgcolor="#bcfffe">
		<?php echo $i-$s5; ?><br>
		<?php
			$n=0;
			foreach ($data as $datum):
				$nittei5=array(
					$datum['Circle']['schedule501'],
					$datum['Circle']['schedule502'],
					$datum['Circle']['schedule503'],
					$datum['Circle']['schedule504'],
					$datum['Circle']['schedule505'],
					$datum['Circle']['schedule506'],
					$datum['Circle']['schedule507'],
					$datum['Circle']['schedule508'],
					$datum['Circle']['schedule509'],
					$datum['Circle']['schedule510'],
					$datum['Circle']['schedule511'],
					$datum['Circle']['schedule512'],
					$datum['Circle']['schedule513'],
					$datum['Circle']['schedule514'],
					$datum['Circle']['schedule515'],
					$datum['Circle']['schedule516'],
					$datum['Circle']['schedule517'],
					$datum['Circle']['schedule518'],
					$datum['Circle']['schedule519'],
					$datum['Circle']['schedule520'],
					$datum['Circle']['schedule521'],
					$datum['Circle']['schedule522'],
					$datum['Circle']['schedule523'],
					$datum['Circle']['schedule524'],
					$datum['Circle']['schedule525'],
					$datum['Circle']['schedule526'],
					$datum['Circle']['schedule527'],
					$datum['Circle']['schedule528'],
					$datum['Circle']['schedule529'],
					$datum['Circle']['schedule530'],
					$datum['Circle']['schedule531'],
				);
				?>
				<?php if($nittei5[$i-$s5-1]==1): ?>
					<?php if($n<3): ?>
						<?php echo $datum['Circle']['name']; ?><br>
						<?php $n=$n+1; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php while($n<4): ?>
				<?php echo ""; ?><br>
				<?php $n=$n+1; ?>
			<?php endwhile; ?>
		</td>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=29;$i<36;$i++): ?>
		<?php if($i-$s5<32): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s5; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei5=array(
						$datum['Circle']['schedule501'],
						$datum['Circle']['schedule502'],
						$datum['Circle']['schedule503'],
						$datum['Circle']['schedule504'],
						$datum['Circle']['schedule505'],
						$datum['Circle']['schedule506'],
						$datum['Circle']['schedule507'],
						$datum['Circle']['schedule508'],
						$datum['Circle']['schedule509'],
						$datum['Circle']['schedule510'],
						$datum['Circle']['schedule511'],
						$datum['Circle']['schedule512'],
						$datum['Circle']['schedule513'],
						$datum['Circle']['schedule514'],
						$datum['Circle']['schedule515'],
						$datum['Circle']['schedule516'],
						$datum['Circle']['schedule517'],
						$datum['Circle']['schedule518'],
						$datum['Circle']['schedule519'],
						$datum['Circle']['schedule520'],
						$datum['Circle']['schedule521'],
						$datum['Circle']['schedule522'],
						$datum['Circle']['schedule523'],
						$datum['Circle']['schedule524'],
						$datum['Circle']['schedule525'],
						$datum['Circle']['schedule526'],
						$datum['Circle']['schedule527'],
						$datum['Circle']['schedule528'],
						$datum['Circle']['schedule529'],
						$datum['Circle']['schedule530'],
						$datum['Circle']['schedule531'],
					);
					?>
					<?php if($nittei5[$i-$s5-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s5>31): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
<tr>
	<?php for($i=36;$i<43;$i++): ?>
		<?php if($i-$s5<32): ?>
			<td bgcolor="#bcfffe">
			<?php echo $i-$s5; ?><br>
			<?php
				$n=0;
				foreach ($data as $datum):
					$nittei5=array(
						$datum['Circle']['schedule501'],
						$datum['Circle']['schedule502'],
						$datum['Circle']['schedule503'],
						$datum['Circle']['schedule504'],
						$datum['Circle']['schedule505'],
						$datum['Circle']['schedule506'],
						$datum['Circle']['schedule507'],
						$datum['Circle']['schedule508'],
						$datum['Circle']['schedule509'],
						$datum['Circle']['schedule510'],
						$datum['Circle']['schedule511'],
						$datum['Circle']['schedule512'],
						$datum['Circle']['schedule513'],
						$datum['Circle']['schedule514'],
						$datum['Circle']['schedule515'],
						$datum['Circle']['schedule516'],
						$datum['Circle']['schedule517'],
						$datum['Circle']['schedule518'],
						$datum['Circle']['schedule519'],
						$datum['Circle']['schedule520'],
						$datum['Circle']['schedule521'],
						$datum['Circle']['schedule522'],
						$datum['Circle']['schedule523'],
						$datum['Circle']['schedule524'],
						$datum['Circle']['schedule525'],
						$datum['Circle']['schedule526'],
						$datum['Circle']['schedule527'],
						$datum['Circle']['schedule528'],
						$datum['Circle']['schedule529'],
						$datum['Circle']['schedule530'],
						$datum['Circle']['schedule531'],
					);
					?>
					<?php if($nittei5[$i-$s5-1]==1): ?>
						<?php if($n<3): ?>
							<?php echo $datum['Circle']['name']; ?><br>
							<?php $n=$n+1; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php while($n<4): ?>
					<?php echo ""; ?><br>
					<?php $n=$n+1; ?>
				<?php endwhile; ?>
			</td>
		<?php endif; ?>
		<?php if($i-$s5>31): ?>
			<td bgcolor="#bcfffe"><br><br><br><br></td>
		<?php endif; ?>
	<?php endfor; ?>
</tr>
</table>
<?php endif; ?>


<ul class="navmenu">
<li><a href="#lunch">ランチメニュー</a></li>
<li><a href="#course">コースメニュー</a></li>
<li><a href="#single">単品メニュー</a></li>
<li><a href="#drink">ドリンクメニュー</a></li>
<li><a href="#desert">デザートメニュー</a></li>
</ul>

<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

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