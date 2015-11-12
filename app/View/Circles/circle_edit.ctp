<h3>登録情報を編集</h3>
<p>
<div class="stop-bottom">

<div class="stop-btm">
	<table class="type01">
		<tbody>
	<?php echo $this->Form->create('Circle');  ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?> 
		
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
					"0"=>'テニス',
					"1"=>'合唱',
					"2"=>'卓球',
					"3"=>'サッカー',
					"4"=>'その他'
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



	<div Align="right">
		
			<?php
				echo '<p> ';
				echo $this->Form->error('name');
				echo '</p>';
				echo $this->Form->end(__('更新')); 
			?>
		
	</div>
</div><!--stop-btm-->
</div><!--stop-bottom-->
</p>   

<p>
	<div Align="right">
	<?php echo $this->Form->postLink('サークル情報を削除',array(
		'action'=>'del',
		$tmp),array('class'=>'btn btn-info'),'サークル情報を消去してもよろしいですか?');?>
	</div>
</p>
<p>
	<font size="3" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
	</font>
</p>


 