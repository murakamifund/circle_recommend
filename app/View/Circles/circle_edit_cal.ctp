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
			echo $this->Form->date('day');
			echo $this->Form->error('day');
		?> (注)右側の矢印をクリック
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
<p>
<div id="fc1" class="fc">
</div>

<script>
	$('#fc1').fullCalendar({
		defaultDate: '2015-11-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2015-11-01'
				},
				{
					title: 'Long Event',
					start: '2015-11-07',
					end: '2015-11-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2015-11-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2015-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2015-11-11',
					end: '2015-11-13'
				},
				{
					title: 'Meeting',
					start: '2015-11-12T10:30:00',
					end: '2015-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2015-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2015-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2015-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2015-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2015-11-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2015-11-28'
				}
			]

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
