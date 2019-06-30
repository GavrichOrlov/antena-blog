@extends('layouts.app')

@section('content')
<div id="primary">
	<div class="cont-inner">
		<section class="about-wrap">
			<h2>サイト情報</h2>
			<section class="about-box">
				<table class="tbl01" summary="サイト情報">
					<tbody><tr class="odd"><th>サイト名</th><td>ワロタあんてな</td></tr>
					<tr><th>開設日</th><td>2019年04月25日</td></tr>
					<tr class="odd"><th>URL</th><td><a href="http://matomeantena.com/">http://matomeantena.com/</a></td></tr>
					<tr><th>アプリ</th><td><a href="http://matomeantena.com/app/introduction">http://matomeantena.com/app/introduction</a></td></tr>
					<tr class="odd"><th>Twitter</th><td><a href="https://twitter.com/matomeantena" target="_blank">https://twitter.com/matomeantena</a></td></tr>
					<tr>
						<th>逆アクセスランキング</th>
						<td>
							<a href="http://matomeantena.com/blogs">http://matomeantena.com/blogs</a>
							<br><a href="http://rranking5.ziyu.net/html/matomeantena.html" rel="nofollow" target="_blank">http://rranking5.ziyu.net/html/matomeantena.html</a>
						</td>
					</tr>
					<tr class="odd">
						<th>in/outの数値について</th>
						<td>
							<ul class="arw-list">
								<li>「当日を含まない過去6日＋当日の現時点までのアクセス数」を表示しています</li>
								<li>in ⇒ PC＆スマホPV計測（不正を除く全クリックを計測）</li>
								<li>out ⇒ PC＆スマホPV計測（不正を除く全クリックを計測）</li>
								<li>数値を水増しする行為は一切しておりません</li>
							</ul>
							<p>※サイト上に表示されているin/outとACR等の逆アクセスの数値が合わない場合、下記の原因が考えられます。</p>
							<ul class="arw-list">
								<li>スマホを集計していない</li>
								<li>全クリックを集計しない設定がなされている</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>お問い合わせ</th>
						<td>
							matomeantena＠yahoo.co.jp（＠を半角に修正して下さい。）<br>
							<span class="arw">相互依頼・削除依頼・ご意見・ご要望等ございましたら、メールにてご連絡お願いいたします。</span>
						</td>
					</tr>
					<tr class="odd"><th>免責事項</th><td>サイト内に表示されている動画、画像等の著作権は各権利所有者に帰属致します。掲載について問題がある場合はたいへんお手数ですが権利所有者様本人がメールでご連絡お願いいたします。また当サイト及びリンク先のサイトを利用したことにより発生した、いかなる損害及びトラブルに関して当方では一切の責任と義務を負いかねますので予めご了承下さい。</td></tr>
				</tbody></table>
			</section>

			<h2>RSS情報</h2>
			<section class="rss-box">
				<div class="rss30">
					<h3>[RSS 14分]</h3>
					<table class="tbl01" summary="RSS 14分">
						<tbody><tr class="odd"><th>総合</th><td><a href="http://matomeantena.com/index1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/index1h.rdf</a></td></tr>
							<tr><th>VIP</th><td><a href="http://matomeantena.com/vip1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/vip1h.rdf</a></td></tr>
							<tr class="odd"><th>ニュース</th><td><a href="http://matomeantena.com/news1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/news1h.rdf</a></td></tr>
							<tr><th>アニメ</th><td><a href="http://matomeantena.com/hobby1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/hobby1h.rdf</a></td></tr>
							<tr class="odd"><th>ゲーム</th><td><a href="http://matomeantena.com/game1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/game1h.rdf</a></td></tr>
							<tr><th>SS</th><td><a href="http://matomeantena.com/story1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/story1h.rdf</a></td></tr>
							<tr class="odd"><th>趣味</th><td><a href="http://matomeantena.com/play1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/play1h.rdf</a></td></tr>
							<tr><th>芸能</th><td><a href="http://matomeantena.com/entertainment1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/entertainment1h.rdf</a></td></tr>
							<tr class="odd"><th>野球</th><td><a href="http://matomeantena.com/sports1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/sports1h.rdf</a></td></tr>
							<tr><th>サッカー</th><td><a href="http://matomeantena.com/soccer1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/soccer1h.rdf</a></td></tr>
							<tr class="odd"><th>生活</th><td><a href="http://matomeantena.com/life1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/life1h.rdf</a></td></tr>
							<tr><th>翻訳</th><td><a href="http://matomeantena.com/world1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/world1h.rdf</a></td></tr>
							<tr class="odd"><th>アダルト</th><td><a href="http://matomeantena.com/adult1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/adult1h.rdf</a></td></tr>
							<tr><th>その他</th><td><a href="http://matomeantena.com/other1h.rdf" rel="nofollow" target="_blank">http://matomeantena.com/other1h.rdf</a></td></tr>
						</tbody>
					</table>
				</div>
			</section>
		</section>
	</div>
</div>
@endsection