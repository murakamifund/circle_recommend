<?php $this->set('title_for_layout', "サークルの予定登録"); ?>
<?php $this->Html->meta('description', "サークル、部活の予定を管理、編集しよう", array('inline' => false)) ?>
<?php
	echo $this->Html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));
 ?>
 
<script>
onload = function(){
	func_circle_edit_cal();	
}
</script>

<h2> <?php echo htmlentities($circle_name); ?> さんのマイページ</h2>
<font color ="#ff0000"><?=$this->Session->flash();?></font>

<h3>イベントを新規作成</h3>
<font color ="#0000ff"><?php echo $this->Session->flash(); ?></font> <!--イベントを削除した際のフラッシュ-->
<p>
<div class ="stop-btm">
<table class = "type01">
<tbody>
<tr>
	<th scope="row">タイトル<br><font color="red">(必須・<nobr>25字以内)</nobr></font></th>

	<td><?php
		echo $this->Form->create('Event');
		?>
		<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
		<?php echo $this->Form->input('circle_id', array('type' => 'hidden','value' => $id)); ?>
		<?php echo $this->Form->input('circle_name', array('type' => 'hidden','value' => $circle_name)); ?>
		<?php echo $this->Form->input('title',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false));
		?>
	<font color="red"><?php echo $this->Form->error('title');?></font>
	</td>
</tr>
<tr>
	<th scope="row">開始日時<br><font color="red">(必須)</font></th>
	
		<td><?php
			echo $this->Form->input('day', array(
    'type' => 'datetime',
    'label' => false,
    'dateFormat' => 'YMD',
    'monthNames' => false,
    'minYear' => date('Y')-1,
    'maxYear' => date('Y')+1,
    'timeFormat' => '24',       //時刻を24時間表記
    'empty' => false,            //空選択可能
	'separator' => array('年 ', '月 <nobr>', '日</nobr> <nobr>','時', '分'),
    'default' => date('Y-m-d H:i'),  //初期値指定
));
			//echo $this->Form->error('day');
		?>
		</nobr>
		<font color="red"><?php echo $this->Form->error('day');?></font>
		</td>
</tr>
<tr>
	<th scope="row">集合場所</th>
	<td><?php echo $this->Form->input('place',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false)); ?>
	<font color="red"><?php echo $this->Form->error('place');?></font>
	</td>
</tr>
<tr>
	<th scope="row">必要な金額</th>
	<td><?php echo $this->Form->input('money',array('size'=>10, 'label'=>false, 'error'=>false, 'div'=>false)); ?> 円
	<font color="red"><?php echo $this->Form->error('money');?></font>
	</td>
</tr>
<tr>
	<th scope="row">新歓かどうか<br><font color="red">(必須)</font></th>
	<td><?php echo $this->Form->radio('for_newcomer',
				array(
					'1'=>'新歓　　',
					'0'=>'新歓ではない'
				),
				array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false,'legend' => false)
				);
	?>
	<font color="red"><?php echo $this->Form->error('for_newcomer');?></font>
	</td>
</tr>
<tr>
	<th scope="row">内容</th>
	<td><?php echo '<nobr>練習';
			echo $this->Form->checkbox('practice',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　　<nobr>試合・本番';
			echo $this->Form->checkbox('game',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　　<nobr>合宿';
			echo $this->Form->checkbox('camp',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　　<nobr>コンパ';
			echo $this->Form->checkbox('party',array('lavel'=>false,'error'=>false,'div'=>false));
			echo '</nobr>　　<nobr>その他';
			echo $this->Form->checkbox('other',array('lavel'=>false,'error'=>false,'div'=>false));
		?></nobr></td>
</tr>
<tr>
	<th scope="row">詳細</th>
	<td><?php echo $this->Form->input('content',array('size'=>30, 'label'=>false, 'error'=>false, 'div'=>false)); ?>
	<font color="red"><?php echo $this->Form->error('content');?></font>
	</td>
</tr>
</tbody>
</table><br>
<div Align="right">
<?php
	echo $this->Form->error('end');
    echo $this->Form->end(__('登録'));
?>
</div>

</div>
</p>


<h3>イベントを編集・削除</h3>

予定をクリックすると編集できます。

<p>
<div id="fc1" class="fc">

</div>

<script>



	
	
	$('#fc1').fullCalendar({
		defaultDate: '2016-02-12',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			selectable: false,
			events:<?php echo $json; ?>
			
			
	});
	
	
    
</script>
</p>

	<div class="i-btn i-btn_cem">
			<a href="circle_edit_main">トップページへ戻る</a>
	</div>
</div>
