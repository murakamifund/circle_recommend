<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
 ?>

<script>
onload = function(){
	func_circle_edit();	
}
</script>

<h2> <?php echo $circle_name; ?>の情報を管理</h2>
<h3>情報を編集</h3>
<p>
<div class="stop-bottom">

<div class="stop-btm">
	<table class="type01">
		<tbody>
	<?php echo $this->Form->create('Circle', array('type'=>'file', 'enctype'=>'multipart/form-data'));  ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?> 
		
		<tr>
			<th scope="row">写真</th>
			<td>
			<?php if($circle_photo != ""): ?>
				<figure><img src="../img/sample_photo2.jpg" width="280" height="210" alt="アップロード用" /></figure>
				<br>
				<?php echo $this->Form->file('Circle.photo', array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false, 'value'=>"../img/アップロード用.png",  'type'=>'file', 'multiple'));?>
			<?php else: ?>
				<?php echo $this->Form->file('Circle.photo', array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false, 'type'=>'file', 'multiple'));?>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			 <th scope="row">サークル名</th>
			<td><?php echo $this->Form->input('circle_name', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?></td>
		</tr>
		<tr>
			<th scope="row">TwitterアカウントのID</th>

			<td><?php echo $this->Form->input('twitterid', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?></td>
		</tr>
		<tr>
			<th scope="row">URL</th>
			<td><?php echo $this->Form->input('url', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?></td>
		</tr>
		<tr>
			<th scope="row">活動内容</th>
			<td><?php echo $this->Form->select('activity',
				array(
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
					"81"=>'その他',
					
				),
				array('size'=>1, 'label'=>false, 'error'=>false, 'div'=>false)
				);?></td>
		</tr>
		<tr>
		 <th scope="row">PR文</th>
			<td><?php echo $this->Form->input('pr', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?></td>
		</tr>
		<tr>
			<th scope="row">活動曜日</th>
		<td><?php echo '月';
			echo $this->Form->checkbox('day1',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '火';
			echo $this->Form->checkbox('day2',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '水';
			echo $this->Form->checkbox('day3',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '木';
			echo $this->Form->checkbox('day4',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '金';
			echo $this->Form->checkbox('day5',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '土';
			echo $this->Form->checkbox('day6',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '日';
			echo $this->Form->checkbox('day7',array('lavel'=>false,'error'=>false,'div'=>false));?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
		<tbody>
		<tr>
			<th scope="row">主な活動場所</th>
			<td><?php echo $this->Form->radio('place',
				array(
					'駒場'=>'駒場',
					'本郷'=>'本郷',
					'その他'=>'その他'
				),
				array('size'=>50, 'label'=>"キャンパス　", 'error'=>false, 'div'=>false,'legend' => false)
				);
			?></td>
			<td><?php echo $this->Form->input('placetext', array('size'=>100, 'label'=>"場所詳細", 'error'=>false, 'div'=>false));?></td>
		</tr>
	</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">男女比</th>
			
			<!--<td>男性人数</td> -->
			<td><?php echo $this->Form->input('man', array('size'=>25, 'label'=>"男性　", 'error'=>false, 'div'=>false)); ?></td>
			
			<!-- <td>女性人数</td>-->
			<td><?php echo $this->Form->input('woman', array('size'=>25, 'label'=>"女性　", 'error'=>false, 'div'=>false));?></td>
		</tr>
	</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">構成</th>
			<td><?php echo $this->Form->radio('intercollege',
				array(
					'学内'=>'学内',
					'インカレ'=>'インカレ'
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				); 
			?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">活動費</th>
			<td><?php echo $this->Form->input('cost_in', array('size'=>25, 'label'=>"入会費", 'error'=>false, 'div'=>false)); ?></td>
				<td><?php echo $this->Form->input('cost', array('size'=>25, 'label'=>"年間費", 'error'=>false, 'div'=>false)); ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td>
				←少ない
				<?php echo $this->Form->radio('nomi',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?>
				多い→
			</td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
				<td>
				←楽しい
				<?php echo $this->Form->radio('mazime',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?>
				ガチ→				
				
				
		
				</td>
		</tr>
	</tbody>
	</table>



	<div Align="right">
		
			<?php
				echo $this->Form->submit('更新', array('name' => 'submit'));
				echo $this->Form->end(); 
			?>
		
	</div>
</div><!--stop-btm-->
</div><!--stop-bottom-->
</p>   



 