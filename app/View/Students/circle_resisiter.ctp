<h2 class="mb1em">サークルログインページ</h2>


<h3 class="mb1em">サークルを登録しよう</h3>
<p>
<div class="stop-bottom">
	<div class ="stop-btm">
	
		<?php echo $this->Form->create('Circle'); 
			  echo '<p>サークル名　: ';
			  echo $this->Form->input('circle_name', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('circle_name');
			  echo '<p>パスワード　: ';
			  echo $this->Form->input('password', array('size'=>50, 'label'=>false, 'error'=>false, 'div'=>false));
			  echo '</p>';
			  echo $this->Form->error('password');
			  echo $this->Form->end(__('登録する')); 
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
</p>   

<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

<!--/lunch-->
</div> <!--<div class="stop-bottom"> -->
</div>