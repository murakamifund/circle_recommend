<h3>登録情報を編集</h3>
<p>
<div class="stop-bottom">

<div class="stop-btm">
	<?php echo $this->Form->create('Circle'); 
			echo $this->Form->input('id', array('type' => 'hidden'));  
			echo '<p>サークル名 : ';
			echo $this->Form->input('circle_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			echo '</p>';
			echo '<p>サークルサイトURL : ';
			echo $this->Form->input('url', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			echo '</p>';
			echo '<p>活動内容 ';
			echo $this->Form->select('activity',
				array(
					"0"=>'テニス',
					"1"=>'合唱',
					"2"=>'卓球',
					"3"=>'サッカー',
					"4"=>'その他'
				),
				array('size'=>1, 'label'=>false, 'error'=>false, 'div'=>false)
				);
			echo '</p>';
			echo '<p>活動日 ';
			echo '月';
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
			echo $this->Form->checkbox('day7',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</p>';
			echo '<p>';
			echo $this->Form->radio('place',
				array(
					'駒場'=>'駒場',
					'本郷'=>'本郷',
					'その他'=>'その他'
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)
				);
			echo '</p>';
			echo '<p>';
			echo $this->Form->radio('intercollege',
				array(
					'学内'=>'学内',
					'インカレ'=>'インカレ',
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)
				);
				echo '</p>';
				echo '<p>男性人数 ';
				echo $this->Form->input('man', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
				echo '</p>';
				echo '<p>女性人数 ';
				echo $this->Form->input('woman', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
				echo '</p>';
				echo '<p>活動費 ';
				echo $this->Form->input('cost', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
				echo '</p>';
				echo '<p>';
				echo $this->Form->radio('nomi',
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
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)
				);
				echo '←ゆるい　　　　　　　　激しい→';
				echo '</p>';
				echo '<p>';
				echo $this->Form->radio('mazime',
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
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)
				);
				echo '←ワイワイ　　　　　　　　ガチ→';
				echo '</p>';
				
				?>




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


 