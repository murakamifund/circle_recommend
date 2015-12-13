<?php 
	$for_newcomer_array = array('新歓','新歓でない');
	$for_newcomer_string = '';
	if($for_newcomer == 1){
		$for_newcomer_string = $for_newcomer_array[0];
	}else{
		$for_newcomer_string = $for_newcomer_array[1];
	}

	$content = array('練習','試合・本番','合宿','飲み会','その他');
	$content_chosen = "";

	if($practice == 1){
		$content_chosen ='練習';
	}else if($game == 1){
		$content_chosen ='試合・本番';
	}else if($camp == 1){
		$content_chosen ='合宿';
	}else if($party == 1){
		$content_chosen ='飲み会';
	}else{
		$content_chosen ='その他';
	}
	
?>


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

	<td>
	<a href="../circle_id/<?php echo $circleid; ?>">
	<font color =#0099ff><?php echo $circle_name; ?>
	</font>
	</a>
	<Div Align="right">←クリックするとサークルの詳細情報が見れます。</Div>
	</td>
	
</tr>
<tr>
	<th scope="row">イベント</th>

	<td><?php echo $title; ?></td>
</tr>
<tr>
	<th scope="row">日時</th>
		<td><?php echo $day; ?></td>
</tr>
<tr>
	<th scope="row">集合場所</th>
		<td><?php echo $place; ?></td>
</tr>
<tr>
	<th scope="row">必要な金額</th>
		<td><?php echo $money; ?>円</td>
</tr>
<tr>
	<th scope="row">新歓かどうか</th>
		<td><?php echo $for_newcomer_string; ?></td>
</tr>
<tr>
	<th scope="row">内容</th>
		<td><?php echo $content_chosen; ?></td>
</tr>
</tbody>
</table><br>

</div>
