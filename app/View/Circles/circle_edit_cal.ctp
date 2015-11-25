<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
 ?>

<h2> <?php echo $circle_name; ?>の情報を管理</h2>

<h3>予定を登録</h3>
<p>
<div class ="stop-btm">
<table class = "type01">
<tbody>
<tr>
	<th scope="row">タイトル</th>

	<td><?php
		echo $this->Form->create('Event');
		?>
		<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('circle_id', array('type' => 'hidden','value' => $id)); ?>
		<?php echo $this->Form->input('circle_name', array('type' => 'hidden','value' => $circle_name)); ?>
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
    'default' => date('Y-m-d H:i', strtotime("2015-11-20 12:33")),  //初期値指定
));
			//echo $this->Form->error('day');
		?>
		</td>
</tr>
</tbody>
</table><br>
<?php
	echo $this->Form->error('end');
    echo $this->Form->end(__('登録'));
?>
<font color ="#0000ff"><?php
    echo $this->Session->flash();
?></font>

</div>
</p>


<h3>予定を編集・削除</h3>

予定をクリックすると編集できます。

<p>
<div id="fc1" class="fc">

</div>

<script>



	
	
	
	$('#fc1').fullCalendar({
		defaultDate: '2015-11-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			events:<?php echo  $json; ?>
			
			
	});
	
	
    
</script>
</p>

<h3>サークル編集トップに戻る</h3>
<div class="stop-bottom">
<div class="stop-btm">
	<div Align="right">
		<div class="i-btn">
			<a href="circle_edit_main">戻る</a>
		</div>
	</div>
</div>
</div>
