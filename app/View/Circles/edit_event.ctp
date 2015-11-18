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
			echo $this->Form->date('day');
			echo $this->Form->error('day');
		?> (注)右側の矢印をクリック
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


