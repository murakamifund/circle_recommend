<h2 class="mb1em">新規登録</h2>

<h3 class="mb1em">すでに登録済みの方はこちらのログインページへ</h3>

	<!--<div Align="right">-->
		<div class="i-btn">
			<a href="student_login">ログインページ</a>
		</div>
	<!--</div>-->
	
	


<div class="stop-bottom">

<h3 class="mb1em">新規登録しよう</h3>
	
	<div class ="stop-btm">
		<?php echo $this->Form->create('Student'); 
			  echo '<p>お名前　　　: ';
			  echo $this->Form->input('student_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('student_name');
			  echo '<p>パスワード　: ';
			  echo $this->Form->input('password', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('password');
			  echo $this->Form->end(__('登録')); 
		?>
		<div class="s-btn">
		</div>
		<p>
		<font size="6" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
		</font>
		</p>
	</div>

</div> <!-- stop-btm -->


<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

<!--/lunch-->
</div> <!--<div class="stop-bottom"> -->
</div>