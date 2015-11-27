<script>
onload = function(){
	func_event_id();	
}
</script>

<h2> <?php echo $circle_name; ?>の<?php echo $title; ?>の情報</h2>


<h3>編集</h3>
<div class ="stop-btm">
<table class = "type01">
<tbody>
<tr>
	<th scope="row">サークル名</th>

	<td><?php echo $circle_name; ?></td>
</tr>
<tr>
	<th scope="row">イベント</th>

	<td><?php echo $title; ?></td>
</tr>
<tr>
	<th scope="row">予定日</th>
		<td><?php echo $day; ?></td>
</tr>
</tbody>
</table><br>

</div>
