<script>
onload = function(){
	func_circle();	
}
</script>


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
<p>
	<font color ="blue">(注)サークルの登録はMYページから行うことができます。<br>サークルが未登録の場合、お手数ですが、<font color ="black"><a href="../Students/student_resister">アカウント登録　</a></font>を行ってサークルを登録してください。</font>
</P>
	
<h3 class="mb1em">Why use? How use?</h3>

<iframe style="border:none" src="http://files.photosnack.com/iframejs/embed.html?hash=pdzp2m8jo&t=1444874503" width="576" height="384" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" ></iframe>



<section id="lunch">

<h3 class="mb1em">ランチメニュー</h3>

<!--/lunch-->
