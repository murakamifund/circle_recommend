<script>
onload = function(){
	func_circle_edit_main();	
}
</script>


<h2> <?php echo $circle_name; ?>の情報を管理</h2>


<h3>情報を編集</h3>
<div class="stop-bottom">
<div class="stop-btm">
<p>
		<div class="i-btn">
			<div Align="center">
			<a href="circle_edit">詳細を編集</a>&nbsp;　&nbsp;　&nbsp;　&nbsp;　&nbsp;　
			<a href="circle_edit_cal">予定を編集</a>
			</div>
		</div>

</p>
<p>
	<font size="3" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
	</font>
</p>
</div>
</div>


<h3>サークルの登録情報を削除</h3>
<p>
	<div Align="right">
	<?php echo $this->Form->postLink('サークル情報を削除',array(
		'action'=>'del',
		$tmp),array('class'=>'btn btn-info'),'サークル情報を消去してもよろしいですか?');?>
	</div>
</p>


<h3>ログアウト</h3>
<div class="stop-bottom">
<div class="stop-btm">
	<div Align="right">
		<div class="i-btn">
			<a href="circle_logout">編集を完了</a>
		</div>
	</div>
</div>
</div>
