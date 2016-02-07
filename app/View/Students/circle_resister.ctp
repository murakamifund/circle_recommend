<script>
onload = function(){
	func_circle_resister();	
}
</script>

<h2 class="mb1em">サークルを登録しよう</h2>

	<div class ="stop-btm">
	<table class = "type01">
	<tbody>
		<?php echo $this->Form->create('Circle'); ?>
		<?php echo $this->Form->input('id', array('type' => 'hidden','value' => $circleid)); ?>
		<tr>
			<th scope="row">サークル名
				<br><font color="red">(25字以内)</font>
			</th>
			<td><?php echo $this->Form->input('circle_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));?>
			<font color="red"><?php echo $this->Form->error('circle_name');?></font>
			</td>
		</tr>
		<tr>
			<th scope="row">キャッチ<nobr>フレーズ</nobr><br>
				<font color="red">(必須・<nobr>25字以内)</nobr></font>
			</th>
			<td><?php echo $this->Form->input('phrase', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));?>
				<font color="red"><?php echo $this->Form->error('phrase');?></font>
			</td>
		</tr>
		<tr>
			<th scope="row">URL</th>
			<td><?php echo $this->Form->input('url', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?>
				<font color="red"><?php echo $this->Form->error('url');?></font>
			</td>
		</tr>
		<tr>
			<th scope="row">活動内容<br>
				<font color="red">(必須)</font>
			</th>
			<td><?php echo $this->Form->select('activity',
				array(
					"テニス"=>'テニス',
					"卓球"=>'卓球',
					"サッカー"=>'サッカー',
					"野球"=>'野球',
					"バスケ"=>'バスケ',
					"バレー"=>'バレー',
					"バドミントン"=>'バドミントン',
					"ラグビー"=>'ラグビー',
					"ホッケー"=>'ホッケー',
					"水泳"=>'水泳',
					"武道"=>'武道',
					"ダンス"=>'ダンス',
					"登山"=>'登山',
					"乗り物"=>'乗り物',
					"スキー"=>'スキー',
					"政治・経済"=>'政治・経済',
					"放送・広告"=>'放送・広告',
					"語学"=>'語学',
					"国際"=>'国際',
					"コンピュータ"=>'コンピュータ',
					"自然科学"=>'自然科学',
					"法学"=>'法学',
					"企業"=>'企業',
					"ロック"=>'ロック',
					"ジャズ"=>'ジャズ',
					"クラシック"=>'クラシック',
					"コーラス"=>'コーラス',
					"映画・写真"=>'映画・写真',
					"演劇・お笑い"=>'演劇・お笑い',
					"美術"=>'美術',
					"文芸"=>'文芸',
					"旅行"=>'旅行',
					"アウトドア"=>'アウトドア',
					"ゲーム"=>'ゲーム',
					"グルメ"=>'グルメ',
					"芸能"=>'芸能',
					"その他"=>'その他',
				),
				array('size'=>1, 'label'=>false, 'error'=>false, 'div'=>false)
				);?></td>
		</tr>
		<tr>
		 <th scope="row">PR文<br>
			<font color="red">(必須・<nobr>200字以内)</nobr></font>
		 </th>
			<td><?php echo $this->Form->input('pr', array('size'=>100, 'label'=>false, 'error'=>false, 'div'=>false));?>
				<font color="red"><?php echo $this->Form->error('pr');?></font>
			</td>
		</tr>
		<tr>
			<th scope="row">活動曜日</th>
		<td><?php echo '月';
			echo $this->Form->checkbox('day1',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　火';
			echo $this->Form->checkbox('day2',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　水';
			echo $this->Form->checkbox('day3',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　木';
			echo $this->Form->checkbox('day4',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　金';
			echo $this->Form->checkbox('day5',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　土';
			echo $this->Form->checkbox('day6',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　<nobr>日';
			echo $this->Form->checkbox('day7',array('lavel'=>false,'error'=>false,'div'=>false))."<nobr>";?></td>
		</tr>
	</tbody>
	</table>
	<table class="type02">
		<tbody>
		<tr>
			<th scope="row">主な活動場所<br>
				<font color="red">(必須)</font>
			</th>
			<td><?php echo $this->Form->radio('place',
				array(
					'駒場'=>'駒場',
					'本郷'=>'本郷',
					'その他'=>'その他'
				),
				array('size'=>50, 'label'=>"キャンパス　", 'error'=>false, 'div'=>false,'legend' => false)
				);
			?></td>
			<td><?php echo $this->Form->input('placetext', array('size'=>100, 'label'=>"場所詳細", 'error'=>false, 'div'=>false));?>
			<font color="red"><?php echo $this->Form->error('placetext');?></font>
			</td>
		</tr>
		<tr>
			<th scope="row">男女比</th>
			
			<!--<td>男性人数</td> -->
			<td><?php echo $this->Form->input('man', array('size'=>5, 'label'=>"男性　", 'error'=>false, 'div'=>false))."人"; ?></td>
			
			<!-- <td>女性人数</td>-->
			<td><?php echo $this->Form->input('woman', array('size'=>5, 'label'=>"女性　", 'error'=>false, 'div'=>false))."人";?></td>
		</tr>
	</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">構成<br>
				<font color="red">(必須)</font></th>
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
			<td><?php echo $this->Form->input('cost_in', array('size'=>10, 'label'=>"入会費", 'error'=>false, 'div'=>false)); ?></td>
				<td><?php echo $this->Form->input('cost', array('size'=>10, 'label'=>"年間費", 'error'=>false, 'div'=>false)); ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td>←少ない <?php echo $this->Form->radio('nomi',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?> 多い→
			</td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
			<td>←楽しい <?php echo $this->Form->radio('mazime',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);?> ガチ→
				
				
				
		
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

