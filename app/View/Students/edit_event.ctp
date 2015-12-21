<script>
onload = function(){
	func_edit_event();	
}
</script>

<h2> <?php echo $circle_name; ?>の<?php echo $title; ?>の予定を編集</h2>


<h3>編集</h3>
<div class ="stop-btm">
<table class = "type01">
<tbody>
<tr>
	<th scope="row">タイトル</th>

	<td><?php
		echo $this->Form->create('Event');
		?>
		<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('title',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false));
		?>
	</td>
</tr>
<tr>
	<th scope="row">開始日時</th>
		<td><?php
			echo $this->Form->input('day', array(
    'type' => 'datetime',
    'label' => false,
    'dateFormat' => 'YMD',
    'monthNames' => false,
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+1,
    'timeFormat' => '24',       //時刻を24時間表記
    'empty' => true,            //空選択可能
	'separator' => array('年', '月', '日','時','分'),
    'default' => date('Y-m-d H:i'),  //初期値指定
));
			//echo $this->Form->error('day');
		?>
		</td>
</tr>
<tr>
	<th scope="row">集合場所</th>
	<td><?php echo $this->Form->input('place',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false)); ?></td>
</tr>
<tr>
	<th scope="row">必要な金額</th>
	<td><?php echo $this->Form->input('money',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false)); ?> 円</td>
</tr>
<tr>
	<th scope="row">新歓かどうか</th>
	<td><?php echo $this->Form->radio('for_newcomer',
				array(
					'1'=>'新歓　　　　',
					'0'=>'新歓ではない'
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);
	?></td>
</tr>
<tr>
	<th scope="row">内容</th>
	<td><?php echo '練習';
			echo $this->Form->checkbox('practice',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　　試合・本番';
			echo $this->Form->checkbox('game',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　　合宿';
			echo $this->Form->checkbox('camp',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '　　その他';
			echo $this->Form->checkbox('other',array('lavel'=>false,'error'=>false,'div'=>false));
		?></td>
	</tr>
</tbody>
</table><br>
<?php
	echo $this->Form->error('end');
    echo $this->Form->end(__('更新'));
?>
<font color ="#0000ff"><?php
    echo $this->Session->flash();
?></font>

</div>


<h3>サークルの登録情報を削除</h3>
<p>
	<div Align="right">
	<?php echo $this->Form->postLink('予定を削除',array(
		'action'=>'delete',
		$event_id),array('class'=>'btn btn-info'),'予定を削除してもよろしいですか?');?>
	</div>
</p>

