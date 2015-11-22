<?php
	echo $this->html->css(array('fullcalendar', 'bootstrap','headshrinker'));
	echo $this->Html->script(array('jquery-1.5.min','jquery-ui-1.8.9.custom.min','jquery.qtip-1.0.0-rc3.min','ready','fullcalendar.min'));

$nomi_custom = array('飲まない','あまり飲まない','普通','飲む','かなり飲む');
$nomi_chosen = $nomi_custom[$nomi-1];

 ?>
 
 
 
<h2> <?php echo $circle_name; ?></h2>

<h3>情報</h3>
<p>
<div class="stop-bottom">

<div class="stop-btm">
	<table class="type01">
		<tbody>
		
		<tr>
			<th scope="row">写真</th>
			<td></td>
		</tr>
		<tr>
			 <th scope="row">サークル名</th>
			<td><?php echo $circle_name; ?></td>
		</tr>
		<tr>
			<th scope="row">TwitterアカウントのID</th>

			<td><?php echo $twitterid; ?></td>
		</tr>
		<tr>
			<th scope="row">URL</th>
			<td><a href="<?php echo $url; ?>"><?php echo $circle_name; ?>のホームページ</a></td>
		</tr>
		<tr>
			<th scope="row">活動内容</th>
			<td><?php echo $activity; ?></td>
		</tr>
		<tr>
		 <th scope="row">PR文</th>
			<td><?php echo $pr; ?></td>
		</tr>
		<tr>
			<th scope="row">活動曜日</th>
		<td></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
		<tbody>
		<tr>
			<th scope="row">主な活動場所</th>
			<td><?php echo $place; ?></td>
			<td><?php echo $placetext; ?></td>
		</tr>
	</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">男女比</th>
			
			<!--<td>男性人数</td> -->
			<td><?php echo $man; ?></td>
			
			<!-- <td>女性人数</td>-->
			<td><?php echo $woman; ?></td>
		</tr>
	</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">構成</th>
			<td><?php echo $intercollege; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type02">
	<tbody>
		<tr>
			<th scope="row">活動費</th>
			<td>入会費<?php echo $cost_in; ?></td>
			<td>年間費<?php echo $cost; ?></td>
		</tr>
		</tbody>
	</table>
	<table class="type01">
		<tbody>
		<tr>
			<th scope="row">飲み会</th>
				<td><?php echo $nomi_chosen; ?></td>
		</tr>
		<tr>
			<th scope="row">雰囲気</th>
				<td><?php echo $mazime; ?></td>
		</tr>
	</tbody>
	</table>
</div><!--stop-btm-->
</div><!--stop-bottom-->
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
