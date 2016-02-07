<script>
onload = function(){
	func_student_resister();
}
</script>
<title>UT-Circle ログインページ</title>

<h2 class="mb1em">ログインページ</h2>
<font color ="#ff0000"><?php echo $this->Session->flash(); ?></font>

<h4 class="mb1em">Twitterアカウントと連携</h3>
<div>学生のかたはこちらからログインしてください。</div>
<p>
<div Align="center">
		<div class="i-btn i-btn_250">
			<a href="pre_student_tw_callback">Twitterと連携</a>
		</div>
</div>
</p>

<h4 class="mb1em">サークルのTwitterアカウントと連携</h3>
<div>学生のかたはこちらからログインしてください。</div>
<p>
<div Align="center">
		<div class="i-btn i-btn_250">
			<a href="pre_circle_tw_callback">サークルのTwitterと連携</a>
		</div>
</div>
</p>
