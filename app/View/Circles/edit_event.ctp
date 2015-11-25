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
		
		<?php echo $this->Form->input('title',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false));
		?>
	</td>
</tr>
<tr>
	<th scope="row">予定日</th>
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
    //'default' => date('Y-m-d H:i', strtotime("2015-11-11 12:00")),  //初期値指定
));
			//echo $this->Form->error('day');
		?>
			<!--<?php
			echo $this->Form->dateTime('day', 'YMD', 'NONE',  array(
				'type' => 'datetime',
				'monthNames' => 'false',
				'maxYear' => date('Y') + 1,
				'minYear' => date('Y'),
				'monthNames' => false,
				'timeFormat' => '24',
				'value' => array('year' => date('Y'), 'month' => date('M'), 'day' => date('d')),
				'separator' => array('年', '月', '日'),
			));
			//echo $this->Form->error('day');
		?> -->
		</td>
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


