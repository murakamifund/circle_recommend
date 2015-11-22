<script>
onload = function(){
	func_student_login();	
}
</script>


<h2 class="mb1em">ログインページ</h2>

<h3 class="mb1em">ログインしよう</h3>
<div class="stop-bottom">
	<div class ="stop-btm">
		<?php echo $this->Form->create('Student'); 
			  echo '<p>お名前　: ';
			  echo $this->Form->input('student_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('student_name');
			  echo '<p>パスワード　: ';
			  echo $this->Form->input('password', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('password');
			  echo $this->Form->end(__('ログイン')); 
		?>
		<div class="s-btn">
		</div>
		<p>
		<font size="6" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
		</font>
		</p>
	</div><!-- stop-btm -->

</div> <!-- stop-bottom -->


<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

<!--/lunch-->
