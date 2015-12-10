<h3>登録情報を編集</h3>
	
<h3 class="mb1em">サークルを登録しよう</h3>
<h3 class="mb1em"><?php echo $tw_user_id;?></h3>
<h3 class="mb1em"><?php echo $user_name;?></h3>
<p>
	<div Align="right">
		<div class="i-btn">
			<?php echo $this->Html->link('サークル登録',array('action' => '../Circles/circle_resister/'.$tw_user_id.''));?>
		</div>
	</div>
</p>

  
<h3>ログアウト</h3>
	
	
<p>
	<div Align="right">
		<div class="i-btn">
			<a href="student_tw_logout">ログアウト</a>
		</div>
	</div>
</p>    