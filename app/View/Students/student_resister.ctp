<script>
onload = function(){
	func_student_resister();
}
</script>
<title>UT-Circle ログインページ</title>

<h2 class="mb1em">新規登録</h2>
<font color ="#0000ff"><?php echo $this->Session->flash(); ?></font>

<h3 class="mb1em">ツイッターと連携</h3>
<p>
<div Align="center">
		<div class="i-btn">
			<a href="pre_student_tw_callback">Twitterと連携</a>
		</div>
</div>
</p>

<h3 class="mb1em">サークルのTwitterアカウント</h3>
<p>
<div Align="center">
		<div class="i-btn">
			<a href="pre_circle_tw_callback">サークルのTwitterで連携</a>
		</div>
</div>
</p>
