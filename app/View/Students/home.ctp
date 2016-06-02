<?php $this->set('title_for_layout', '東大のサークル紹介 UT-Circle') ?>
<?php $this->Html->meta('description', 'UT-Circleは、東大の部活動、サークル活動を紹介するWebサービスです。カレンダー機能で自分だけの新歓スケジュールを作成できる他、バイト、インターン情報など大学生活に役立つ情報を提供。', array('inline' => false)) ?>
		
<script>
onload = function(){
	func_home();	
}
</script>

<section>
	<h1>東大の人気サークル、部活を見つけよう!</h1>
</section>

<section>
	<h2>UT-Circleへようこそ!!</h2>
	<p>
		UT-Circleをご利用いただきありがとうございます。<br><br>
		UT-Circleは、東京大学のサークルを紹介するWebサービスです。Twitterと連携し、「SNS上での新歓」というスタイリッシュな新歓を提供します。<br>
		現在、当サイトの登録ユーザー数は <span class="strong_num"><?php echo htmlentities($total_user);?></span> 名、登録団体数は <span class="strong_num"><?php echo htmlentities($total_circle);?></span> 件です。<br>
	</p>
</section>


<section>
	<h2>UT-Circleの使い方</h2>
	
	<h4>学生の方</h4>
	<aside class="mb1em"><a href="student"><img src="../img/image1.jpg" width="700" height="99" alt="" class="wa"></a></aside>
	<p>サークル、部活を探したい学生はこちら!自分にあったサークルを見つけ、新歓の予定を確認しよう!<br></p>

	<h4>サークル・部活の方</h4>
	<aside class="mb1em"><a href="circle"><img src="../img/image2.png" width="700" height="99" alt="" class="wa"></a></aside>
	<P>
		サークル、部活のTwitterアカウントで連携することで、自分の団体を登録!</br>
		団体の詳細情報や予定を共有することで、新入生にサークルの良さを見つけてもらうと同時に、Twitter上でのスマートな新歓を行おう!
	</p>
	
	<h4>Twitterアカウントで連携しよう</h4>
	<aside class="mb1em"><a onclick="display_popup()"><img src="../img/image3.png" width="700" height="99" alt="" class="wa"></a></aside>
	<P>
		TwitterアカウントでUT-Circleと連携しよう!</br>
		サークルのお気に入り登録、スケジュール管理などが行えるだけでなく、東大生向けの高給バイトやインターンのオファーを受けられます!!
	</p>

</section>



<section id="new">
	<h2 id="newinfo_hdr" class="open">更新情報・お知らせ</h2>
	<dl id="newinfo">
		<dt><time datetime="2016-02-04">2016/02/04</time></dt>
		<dd>サイトを開設しました！</dd>
	</dl>
</section>

</div>
<!--/main-->

