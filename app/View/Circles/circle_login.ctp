<h2 class="mb1em">サークル情報・予定を編集しよう</h2>
<p>
サークル登録時に送信したサークル名とパスワードを入力してください。<br>
パスワードなどがわからない場合は、サークル登録者に問い合わせてください。
<br>
</P>
<h3 class="mb1em">編集ページの認証</h3>
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
			  echo $this->Form->end(__('編集')); 
		?>
		<div class="s-btn">
		</div>
		<p>
		<font size="6" color="#0000ff">
		<?php echo $this->Session->flash(); ?>
		</font>
		</p>
	</div> <!-- stop-btm -->

</div> <!-- stop-bottom -->


<section id="lunch">



<!--/lunch-->
