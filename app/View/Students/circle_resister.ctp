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
			echo '　<nobr>金';
			echo $this->Form->checkbox('day5',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　<nobr>土';
			echo $this->Form->checkbox('day6',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　<nobr>日';
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
			<td><nobr><?php echo $this->Form->radio('place',
				array(
					'駒場'=>'駒場',
					'本郷'=>'本郷',
					'その他'=>'その他'
				),
				array('size'=>50, 'label'=>"キャンパス　", 'error'=>false, 'div'=>false,'legend' => false,'separator' => "</nobr>　<nobr>")
				);
			?></td>
			<td><?php echo $this->Form->input('placetext', array('size'=>100, 'label'=>"場所詳細", 'error'=>false, 'div'=>false));?>
			<font color="red"><?php echo $this->Form->error('placetext');?></font>
			<nobr></td>
		</tr>
		<tr>
			<th scope="row">男女比</th>
			
			<!--<td>男性人数</td> -->
			<td><?php echo "男性　<nobr>". $this->Form->input('man', array('size'=>3, 'label'=>false, 'error'=>false, 'div'=>false))."人</nobr>"; ?></td>
			
			<!-- <td>女性人数</td>-->
			<td><?php echo "女性　<nobr>". $this->Form->input('woman', array('size'=>3, 'label'=>false, 'error'=>false, 'div'=>false))."人</nobr>";?></td>
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
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false,'separator'=>'　')
				); 
			?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">活動費</th>
			<td><?php echo "入会費　<nobr>". $this->Form->input('cost_in', array('size'=>5, 'label'=>false, 'error'=>false, 'div'=>false))."円</nobr>"; ?></td>
				<td><?php echo "年間費　<nobr>". $this->Form->input('cost', array('size'=>5, 'label'=>false, 'error'=>false, 'div'=>false))."円</nobr>"; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td><nobr>←少ない</nobr>　<nobr> <?php echo $this->Form->radio('nomi',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false,'separator'=>"</nobr>　<nobr>")
				);?> </nobr>　<nobr>多い→</nobr>
			</td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
			<td><nobr>←楽しい</nobr>　<nobr> <?php echo $this->Form->radio('mazime',
				array(
					'1'=>'1',
					'2'=>'2',
					'3'=>'3',
					'4'=>'4',
					'5'=>'5',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false,'separator'=>"</nobr>　<nobr>")
				);?> </nobr>　<nobr>ガチ→</nobr>
				
				
				
		
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

