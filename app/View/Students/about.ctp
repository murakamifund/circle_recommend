<script>
onload = function(){
	func_about();
}
</script>

<section>
<h2>レスポンシブWEBデザインについて</h2>
<p>当テンプレートは、PC、スマホ、タブレット共通で閲覧可能なレスポンシブWEBデザインになっております。<br>
古いブラウザ（※特にIE8以下）で閲覧した場合にCSSの一部が適用されない（各を丸くする加工やグラデーションなどの加工等）のでご注意下さい。古いブラウザでも最低限見れる状態にはしてありますが、必要に応じて各htmlのhead内の&lt;!--[if lt IE 9]&gt;から&lt;![endif]--&gt;
の間に調整用のCSSを記述して下さい。<br>
また、簡易チェックにはPCを使う場合が多いと思いますのでタブレットやスマホ用のCSSにもPC環境用の設定が入っている場合があります。不要なら削除して下さい。</p>
</section>

<section>
<h2>各デバイスごとのレイアウトチェックは</h2>
<p>最終的なチェックは実際のタブレットやスマホで行うのがおすすめですが、臨時チェックは最新のブラウザ(IEならIE10以降)で行う事もできます。ブラウザの幅を狭くしていくと、タブレットやスマホ環境でのレイアウトになります。</p>
</section>

<section>
<h2>各デバイス用のスタイル変更は</h2>
<p>cssフォルダのstyle.cssファイルで行って下さい。詳しい説明も入っています。</p>
<p>スマホ用とタブレット用のスタイルはcssファイル後半に入っています。<br>
media=&quot; (～)&quot;の「～」部分でcssを切り替えるディスプレイのサイズを設定しています。ここは必要に応じて変更も可能です。</p>
<p>最新のスマートフォンなどは、画面サイズや解像度が上がってきている為、PCと同じ画面が表示される場合もあります。調整したい場合は上のcssの切り替えサイズを変更してみて下さい。</p>
</section>

<section>
<h2>当テンプレートの使い方</h2>
<p><strong class="color1">■titleタグの設定はとても重要です。念入りにワードを選んで適切に入力しましょう。</strong><br />
まず、htmlソースが見れる状態(メモ帳などで開いてもOK)にして、<br />
<span class="look">&lt;title&gt;カフェ向け 無料ホームページテンプレート tp_cafe10&lt;/title&gt;</span><br />
を編集しましょう。あなたのホームページ名が「SAMPLE CAFE」だとすれば、<br />
<span class="look">&lt;title&gt;SAMPLE CAFE&lt;/title&gt;</span><br />
とすればＯＫです。SEO対策もするなら冒頭に重要なワードを入れておきましょう。</p>
<p>続いて、下の方の<br />
<span class="look">Copyright&copy; 2014 SAMPLE CAFE All Rights Reserved.</span><br />
もあなたのサイト名に変更します。「2014」部分はその年その年にあわせて変更していって下さい。</p>
<p><strong class="color1">■サイト名を変更しましょう。</strong><br />
baseフォルダに入っている、logo.png(透明度を保ったロゴ画像の土台)にサイト名をのせて、../imgフォルダに上書きして下さい。<br>
画像サイズが配置サイズよりも大きい(希望サイズの縦横２倍で制作し、html側は希望サイズを指定)のは、高解像度のデバイスで見た場合にボケるのを防ぐ為です。<br>
他の画像についても劣化して見えないようにしたいなら縦横倍のサイズで作ってhtml側で半分に設定してあげて下さい。背景画像もサイズ変更は可能ですが、当テンプレートでは使っていない為、外部のマニュアルなど検索してみて下さい。<br>
補足：gif画像の場合はキレイに縮小されないので使わない方が無難です。</p>
<p><strong class="color1">■metaタグを変更しましょう。</strong><br />
htmlソースが見える状態にしてmetaタグを変更しましょう。</p>
<p>ソースの上の方に、<br />
<span class="look">content=&quot;ここにサイト説明を入れます&quot;</span><br />
という部分がありますので、テキストをサイトの説明文に入れ替えます。検索結果の文面に使われる場合もありますので、見た人が来訪したくなるような説明文を簡潔に書きましょう。</p>
<p>続いて、その下の行の<br />
<span class="look">content=&quot;キーワード１,キーワード２,～～～&quot;</span><br />
も設定します。ここはサイトに関係のあるキーワードを入れる箇所です。10個前後ぐらいあれば充分です。キーワード間はカンマ「,」で区切ります。</p>
</section>

<section>
<h2>上部のメインメニューについて</h2>
<p><strong class="color1">■現在表示中のメニューについて</strong><br />
ページが開いているメニューの状態にしたい場合は、&lt;li<span class="color1"> id=&quot;current&quot;</span>&gt;とid指定を追加すればOKです。</p>
<p><strong class="color1">■全メニューの上部のボーダーを見えるようにする事もできます</strong><br />
全メニューの上部に5pxずつのボーダーが入っているのですが、current以外は見えないようになっています。<a href="sample">全部表示させてあげるとこのようになります</a>。</p>
</section>

<section>
<h2>トップページのスライドショー画像について</h2>
<p>
<strong class="color1">■当テンプレートの画像のスライド表示は<a href="http://www.crytus.co.jp/">有限会社クリタス様</a>提供のプログラムを使用しています。slide_simple_pack.jsファイルは改変せずにご利用下さい。<br>
また、当社配布以外のテンプレートにプログラムのみを使う場合は<a href="http://template-party.com/free_program/program2_license">こちらの規約</a>をお守り下さい。</strong></p>
<p><strong class="color1">■使い方解説</strong><br />
トップページのメイン写真はjavascriptを使用したスライドショーになっています。</p>
<p>お手持ちの写真と入れ替える場合、幅977px、高さ260pxのjpg画像を3枚準備します。<br />
3枚の画像名は表示順に、<br />
<span class="look">1.jpg</span>　<span class="look">2.jpg</span>　<span class="look">3.jpg</span><br />
とします。3枚の画像完成後、../imgフォルダに3枚の画像を上書き保存します。これで現在のスライドショー映像が入れ替わります。<br />
<strong class="color1">■画像サイズを変更したい場合。</strong><br /> 
例えば、画像の高さを<span class="look">180px</span>にしたい場合、まず画像をこのサイズで３枚準備します。次に、スライドショー部分のタグ内に、<br />
<span class="look">width=&quot;977&quot; height=&quot;260&quot;</span><br />
という箇所が２箇所ありますので、これを、<br />
<span class="look">width=&quot;977&quot; height=&quot;180&quot;</span><br />
に変更します。<br />
更に、style.cssの「#mainimg」の設定内にある、<br />
<span class="look">height: 260px;</span><br />
を<br />
<span class="look">height: 180px;</span><br />
に変更して下さい。<br />
<strong class="color1">■最大5枚まで画像の追加が可能です。</strong><br /> 
homeのスライドショー画像がある部分のhtml側に、<br />
<span class="look">&lt;img class=&quot;slide_file&quot; src=&quot;../img/1.jpg&quot; title=&quot;home&quot;&gt;<br />
&lt;img class=&quot;slide_file&quot; src=&quot;../img/2.jpg&quot; title=&quot;home&quot;&gt;<br />
&lt;img class=&quot;slide_file&quot; src=&quot;../img/3.jpg&quot; title=&quot;home&quot;&gt;</span><br />
の行があるので、この下に追加タグを加えて下さい。例えば4.jpgの画像を１枚追加するなら、上記の３行タグを含めて、<br />
<span class="look">&lt;img class=&quot;slide_file&quot; src=&quot;../img/1.jpg&quot; title=&quot;home&quot;&gt;<br />
&lt;img class=&quot;slide_file&quot; src=&quot;../img/2.jpg&quot; title=&quot;home&quot;&gt;<br />
&lt;img class=&quot;slide_file&quot; src=&quot;../img/3.jpg&quot; title=&quot;home&quot;&gt;<br />
&lt;img class=&quot;slide_file&quot; src=&quot;../img/4.jpg&quot; title=&quot;home&quot;&gt;</span><br />
といったタグになります。<br />
<strong class="color1">■各画像ごとにリンクを設定できます。</strong><br />
上記の各画像タグに、<span class="look">titleでリンク先の設定</span>がされています。ダウンロード時点では全てhomeがリンク先になっていますので、ご希望に合わせてリンク先アドレスを変更して下さい。<br />
リンクを設定したくない場合、<br />
<span class="look">&lt;a href=&quot;home&quot; id=&quot;slide_link&quot;&gt;</span><br />
のリンクタグを削除してもらえればＯＫ。閉じタグ（<span class="look">&lt;/a&gt;</span>）の削除もお忘れなく。<br />
<strong class="color1">■希望するループ回数でストップさせる事ができます。</strong><br />
<span class="look">&lt;input type=&quot;hidden&quot; id=&quot;slide_loop&quot; value=&quot;0&quot;&gt;</span><br />
という行があるので、ここの「<span class="look">value=&quot;0&quot;</span>」の数字(ループ回数)を指定して下さい。「0」のままだとエンドレスでループします。<br />
<strong class="color1">■スライドショーの速度を変更したい場合は</strong><br />
<a href="http://template-party.com/tips/tips11">こちらに解説がありますのでご参照下さい。</a><br />
<strong class="color1">■サーバーにアップ後、スライドショーが表示されない場合。</strong><br />
slide_simple_pack.jsファイルがアップロードされているかご確認下さい。ビルダーでアップしている場合、jsファイルがアップされない場合もあるようなのでご確認下さい。アップされている場合、スライドショー用の写真がアップロードされているか、上の説明にあるようにファイル名を間違えていないかもご確認下さい。<br />
<strong class="color1">■スライドショーではなく、通常の固定画像にしたい場合は</strong><br />
梱包の<a href="home_sample">home_sample</a>をhomeに変更してご利用下さい。<br />
<strong class="color1">■画像加工承っております。</strong><br />
１枚1,000円より画像加工も承り中。見積もり無料なのでお気軽にご相談下さい。</p>
</section>

<section>
<h2>トップページの「更新情報・お知らせ」の開閉ブロックについて</h2>
<p><strong class="color1">■当テンプレートの開閉ブロックパーツは<a href="http://www.crytus.co.jp/">有限会社クリタス様</a>提供のプログラムを使用しています。openclose.jsファイルは改変せずにご利用下さい。<br>
また、当社配布以外のテンプレートにプログラムのみを使う場合は<a href="http://template-party.com/free_program/openclose_license">こちらの規約</a>をお守り下さい。</strong></p>
<p><strong class="color1">■使い方解説</strong><br>
画面幅が480px以下である場合にブロックを閉じた状態で表示させています。サイズを変更したい場合は、htmlの下の方にある、<br>
<span class="color1">if (OCwindowWidth() &lt; 480) {
</span><br>
の<span class="color1">480</span>の数字を変更して下さい。<br>
また、PCなどの大きな端末を含めて同じような開閉ブロックとして使いたい場合はこの数字を3000など大きくしておけばOKです。</p>
<p>尚、PCなどでブラウザのサイズを変更して動作確認をする場合、<span class="color1">更新（再読み込み）</span>をしないと反映されませんのでご注意下さい。</p>
</section>

<section>
<h2>プレビューでチェックすると警告メッセージが出る場合（一部のブラウザ対象）</h2>
<p>IE8以下でのレイアウト崩れをさせない為に読み込んでいる「html5.js」にやトップページのスライドショーのjsファイル対して出る警告ですが、WEB上では警告は出ません。また、この警告が出ている間は効果も見る事ができないので、警告を解除してあげて下さい。これにより効果がちゃんと見れるようになります。</p>
</section>



</div>