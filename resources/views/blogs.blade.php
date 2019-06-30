@extends('layouts.app')

@section('content')

<div id="primary">
	<div class="cont-inner">
		<section class="main-box">
			<div class="ttl">
				<h2><span>登録ブログ一覧</span></h2>
				<ul class="count pc">
					<li class="in"><span>{{$in_out_datas['pc_in']}}</span></li>
					<li class="out"><span>{{$in_out_datas['pc_out']}}</span></li>
				</ul>
				<ul class="count sp">
					<li class="in"><span>{{$in_out_datas['sp_in']}}</span></li>
					<li class="out"><span>{{$in_out_datas['sp_out']}}</span></li>
				</ul>
				<ul class="count all">
					<li class="in"><span>{{$in_out_datas['total_in']}}</span></li>
					<li class="out"><span>{{$in_out_datas['total_out']}}</span></li>
				</ul>
			</div>
			<ul class="list">
				<?php $i = 1; ?>
                @foreach($rss_sites as $key => $result)
                    <?php if (($i%2) == 0) {
                      ?>
                      <li>
						<span class="rank">{{$i}}</span>
						<span class="favi"><a rel="nofollow" href="/blog/{{$result->id}}"><img src="{{$result->icon_url}}" alt="{{$result->name}}" width="16" height="16"></a></span>
						<span class="text"><a class="blog-count" onmousedown="return blog_count(this);" href="{{$result->site_url}}" blog_id="530" title="{{$result->name}}" target="_blank">{{$result->name}}</a></span>
						<span class="pc"><span class="in">{{$result->rss_pc_in}}</span><span class="out">{{$result->rss_pc_out}}</span></span>
						<span class="sp"><span class="in">{{$result->rss_sp_in}}</span><span class="out">{{$result->rss_sp_out}}</span></span>
						<span class="all"><span class="in">{{$result->rss_pc_in + $result->rss_sp_in}}</span><span class="out">{{$result->rss_pc_out + $result->rss_sp_out}}</span></span>
					</li>
                    <?php 
                    } else { 
                    ?>
                      <li class="even">
						<span class="rank">{{$i}}</span>
						<span class="favi"><a rel="nofollow" href="/blog/{{$result->id}}"><img src="{{$result->icon_url}}" alt="{{$result->name}}" width="16" height="16"></a></span>
						<span class="text"><a class="blog-count" onmousedown="return blog_count(this);" href="{{$result->site_url}}" blog_id="530" title="{{$result->name}}" target="_blank">{{$result->name}}</a></span>
						<span class="pc"><span class="in">{{$result->rss_pc_in}}</span><span class="out">{{$result->rss_pc_out}}</span></span>
						<span class="sp"><span class="in">{{$result->rss_sp_in}}</span><span class="out">{{$result->rss_sp_out}}</span></span>
						<span class="all"><span class="in">{{$result->rss_pc_in + $result->rss_sp_in}}</span><span class="out">{{$result->rss_pc_out + $result->rss_sp_out}}</span></span>
					</li>
                    <?php 
                    }
                    $i++;
                    ?>
                @endforeach
			</ul>	
		</section>
	</div>
</div>
@endsection
   <!--  <script type="text/javascript">
        var header_height = document.getElementById("header");
        header_height = (header_height == null  ? 0 : header_height.offsetHeight);
        console.log(header_height);
        var title_height = document.getElementById("page_title").offsetHeight;
        var search_height = document.getElementById("input_search_box").offsetHeight;
        var footer_height = document.getElementById("footer").offsetHeight;
        var content_height = window.innerHeight - header_height - title_height - search_height - footer_height- 45;
        document.getElementById("search_contents").setAttribute("style", "min-height: "+ content_height +"px");
    </script> -->
<!-- </html> -->
