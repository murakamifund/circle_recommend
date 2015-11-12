<h2 class="mb1em">サークルを登録しよう</h2>


<h3 class="mb1em">登録フォームに入力しよう</h3>
	<div class ="stop-btm">
	<table class = "type01">
	<tbody>
		<?php echo $this->Form->create('Circle'); ?>
		<tr>
			<th scope="row">サークル名</th>
			<td><?php echo $this->Form->input('circle_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));?>
			<?php echo $this->Form->error('circle_name');?>
			</td>
		</tr>
		<tr>
			<th scope="row">パスワード</th>
			 <td><?php echo $this->Form->input('password', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false)); ?>
			 <?php echo $this->Form->error('password');  ?></td>
		</tr>
	</tbody>
	</table>
			 
		<div class="s-btn">
			<?php echo $this->Form->end(__('作成')); ?>
		</div>
		<p>
		<font size="6" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
		</font>
		</p>
	</div><!-- stop-btm -->




<h3 class="mb1em">個人ページに戻る</h3>
<div Align="right">
		<div class="i-btn">
			<a href="../Students/student_edit">個人ページに戻る</a>
		</div>
</div>
