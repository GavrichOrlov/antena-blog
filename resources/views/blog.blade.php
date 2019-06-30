@extends('layouts.app')

@section('content')

<div id="primary">
	<div class="cont-inner">
		<section class="main-box">
			<div class="ttl">
				<h2><a class="blog-count" onmousedown="return blog_count(this);" href="{{$in_out_datas->site_url}}" blog_id="530" title="{{$in_out_datas->name}}" target="_blank"><span>{{$in_out_datas->name}}</span></a></h2>
				<ul class="count">
					<li class="in"><span>{{$in_out_datas->rss_pc_in + $in_out_datas->rss_sp_in}}</span></li>
					<li class="out"><span>{{$in_out_datas->rss_pc_out + $in_out_datas->rss_sp_out}}</span></li>
				</ul>
			</div>
			<ul class="list">
				<?php $i = 1; ?>
                @foreach($results as $key => $result)
                    <?php if (($i%2) == 0) {
                      ?>
                      <li>
						<span class="data">{{$result->date}}<span class="time">{{$result->time}}</span></span>
						<span class="favi"><img src="{{$in_out_datas->icon_url}}" alt="{{$in_out_datas->name}}" width="16" height="16"></span>
						<span class="text"><a class="feed-click" onmousedown="return click_out({{$in_out_datas->id}});" href="{{$result->article_url}}" title="{{$result->title}}" rel="nofollow" target="_blank">{{$result->title}}</a></span>
					</li>
                    <?php 
                    } else { 
                    ?>
                      <li class="even">
						<span class="data">{{$result->date}}<span class="time">{{$result->time}}</span></span>
						<span class="favi"><img src="{{$in_out_datas->icon_url}}" alt="{{$in_out_datas->name}}" width="16" height="16"></span>
						<span class="text"><a class="feed-click" onmousedown="return click_out({{$in_out_datas->id}});" href="{{$result->article_url}}" title="{{$result->title}}" rel="nofollow" target="_blank">{{$result->title}}</a></span>
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