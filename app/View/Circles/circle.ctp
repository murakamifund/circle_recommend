<h2 class="mb1em">サークルを登録しよう</h2>

<h3 class="mb1em">すでに登録済みの方はこちらのログインページへ</h3>

	<!--<div Align="right">-->
		<div class="i-btn">
			<a href="circle_login">ログインページ</a>
		</div>
	<!--</div>-->
	
	
<h3 class="mb1em">Why use? How use?</h3>

<iframe style="border:none" src="http://files.photosnack.com/iframejs/embed.html?hash=pdzp2m8jo&t=1444874503" width="576" height="384" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" ></iframe>

	
<div class="stop-bottom">
<h3 class="mb1em">登録フォームに入力しよう</h3>
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
	</div>

</div> <!-- stop-btm -->


<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

<!--/lunch-->
</div> <!--<div class="stop-bottom"> -->
</div>