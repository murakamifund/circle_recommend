<h2 class="mb1em">サークルを登録しよう</h2>

<br>
<h3 class="mb1em">登録フォームに入力しよう</h3>
	<div class ="stop-btm">
	<table class = "type01">
	<tbody>
		<?php echo $this->Form->create('Circle'); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden',)); ?>
		<?php echo $this->Form->input('student_id', array('type' => 'hidden','value' => $student_id)); ?>
		<tr>
			<th scope="row">サークル名</th>
			<td><?php echo $this->Form->input('circle_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));?>
			<?php echo $this->Form->error('circle_name');?>
			<br>(注)サークル名はサークル情報の更新に必要です。サークル情報編集者で共有してください。
			</td>
		</tr>
		<tr>
			<th scope="row">パスワード</th>
			 <td><?php echo $this->Form->input('password', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)); ?>
			 <br>(注)パスワードはサークル情報の更新に必要です。きちんと管理し、サークル情報編集者で共有してください。
			 <?php echo $this->Form->error('password');  ?></td>
		</tr>
		
		<tr>
			<th scope="row">サークルTwitterアカウントID</th>
			 <td><?php echo $this->Form->input('twitterid', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)); ?></td>
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
		<tr>
			<th scope="row">男女比</th>
			
			<!--<td>男性人数</td> -->
			<td><?php echo $this->Form->input('man', array('size'=>50, 'label'=>"男性　", 'error'=>false, 'div'=>false)); ?></td>
			
			<!-- <td>女性人数</td>-->
			<td><?php echo $this->Form->input('woman', array('size'=>50, 'label'=>"女性　", 'error'=>false, 'div'=>false));?></td>
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
			<td><?php echo $this->Form->input('cost_in', array('size'=>50, 'label'=>"入会費", 'error'=>false, 'div'=>false)); ?></td>
				<td><?php echo $this->Form->input('cost', array('size'=>50, 'label'=>"年間費", 'error'=>false, 'div'=>false)); ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td><?php echo $this->Form->radio('nomi',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
					'6'=>'6',
					'7'=>'7',
					'8'=>'8',
					'9'=>'9',
					'10'=>'10',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?>
				<br>←少ない　　　　　　　　多い→
			</td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
			<td><?php echo $this->Form->radio('mazime',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
					'6'=>'6',
					'7'=>'7',
					'8'=>'8',
					'9'=>'9',
					'10'=>'10',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?>
				<br>←楽しい　　　　　　　　ガチ→
				
				
				
		
				</td>
		</tr>
	</tbody>
	</table>
		<div class="s-btn">
			<?php echo $this->Form->end(__('作成')); ?>
		</div>
		<p>
		<font size="6" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
		</font>
		</p>
	</div><!-- stop-btm -->




<h3 class="mb1em">個人ページに戻る</h3>
<div Align="right">
		<div class="i-btn">
			<a href="../../Students/student_edit">個人ページに戻る</a>
		</div>
</div>
