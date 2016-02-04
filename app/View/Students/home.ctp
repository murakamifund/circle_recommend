<script>
onload = function(){
	func_home();	
}
</script>

<meta name="description" content="東大の部活動、サークル活動を紹介！カレンダー機能で自分だけの新歓スケジュールを作成しよう。その他にもバイト、インターン情報など大学生活に役立つ情報を提供。">
<title>UT-Circle 東大のサークル探し</title>

<section>
<h2>UT-Circleへようこそ!!</h2>
<p>
UT-Circleをご利用いただきありがとうございます。
<br>
<br>
UT-Circleは、東京大学のサークルを紹介するWebサービスです。Twitterと連携し、「SNS上での新歓」というスタイリッシュな新歓を提供します。
<br>
現在、当サイトの登録ユーザー数は <span class="strong_num"><?php echo $total_user;?></span> 名、登録団体数は <span class="strong_num"><?php echo $total_circle;?></span> 件です。<br>
</p>

</section>

<section>
<h2>UT-Circleの使い方</h2>
<h4>学生の方</h4>

<aside class="mb1em"><a href="student"><img src="../img/image1.jpg" width="700" height="99" alt="" class="wa"></a></aside>
<p>
	サークル、部活を探したい学生はこちら!自分にあったサークルを見つけ、新歓の予定を確認しよう!<br>
	
</p>
<!--
<div><a class="access_btn" href="student">STUDENT</a></div>
<div class="btn_nav">サークル、部活を探したい学生はこちら!自分にあったサークルを見つけ、新歓の予定を確認しよう!</div>
-->
<h4>サークル・部活の方</h4>

<aside class="mb1em"><a href="circle"><img src="../img/image2.png" width="700" height="99" alt="" class="wa"></a></aside>
<P>
	サークル、部活のTwitterアカウントで連携することで、自分の団体を登録!</br>
	団体の詳細情報や予定を共有することで、新入生にサークルの良さを見つけてもらうと同時に、Twitter上でのスマートな新歓を行おう!
</p>
<!--
<div><a class="access_btn" href="../Circles/circle">CIRCLE</a></div>
<div class="btn_nav">サークルの登録・サークル情報の編集などはこちら！（サークル登録をするには、まず「新規登録」から学生の登録をしてください。）</div>
-->
<h4>Twitterアカウントで連携しよう</h4>
<aside class="mb1em"><a onclick="display_popup()"><img src="../img/image3.png" width="700" height="99" alt="" class="wa"></a></aside>
<P>
	TwitterアカウントでUT-Circleと連携しよう!</br>
	サークルのお気に入り登録、スケジュール管理などが行えるだけでなく、東大生向けの高給バイトやインターンのオファーを受けられます!!
</p>
<!--<div><a class="access_btn" href="student_resister">新規登録</a></div>
<div class="btn_nav">もっと充実した機能を使いたい学生さんはこちら！学生登録をすることで、お気に入りサークルの登録などが出来ます。</div>
-->
</section>



<section id="new">
<h2 id="newinfo_hdr" class="open">更新情報・お知らせ</h2>
<dl id="newinfo">
<dt><time datetime="2016-02-04">2016/02/04</time></dt>
<dd>サイト開設</dd>
<!-- ここに追加、更新情報を載せる-->
</dl>
</section>

</div>
<!--/main-->

