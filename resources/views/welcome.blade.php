@extends('layouts.app')

@section('content')
<div id="primary">
    <div class="cont-inner">
        <section class="main-box">
            <div class="ttl">
                <h2><span>最新記事一覧</span></h2>
            </div>
            <ul class="list" id="scrollbar">
                <?php $i = 1; ?>
                @foreach($rss_sites as $key => $result)
                    <?php if (($i%2) == 0) {
                      ?>
                      <li>
                        <span class="data">{{$result->date}}<span class="time">{{$result->time}}</span></span>
                        <span class="favi"><img src="/public{{$result->icon_url}}" alt="{{$result->name}}" width="16" height="16"></span>
                        <span class="text"><a class="feed-click" onmousedown="return click_out({{$result->id}});" href="{{$result->article_url}}" title="{{$result->title}}" rel="nofollow" target="_blank"><?php echo $result->title;?></a></span>
                        <span class="site"><a rel="nofollow" href="/blog/{{$result->id}}" title="{{$result->name}}"><?php echo $result->name; ?></a></span>
                    </li>
                    <?php 
                    } else { 
                    ?>
                      <li class="even">
                        <span class="data">{{$result->date}}<span class="time">{{$result->time}}</span></span>
                        <span class="favi"><img src="/public{{$result->icon_url}}" alt="{{$result->name}}" width="16" height="16"></span>
                        <span class="text"><a class="feed-click" onmousedown="return click_out({{$result->id}});" href="{{$result->article_url}}" title="{{$result->title}}" rel="nofollow" target="_blank"><?php echo $result->title;?></a></span>
                        <span class="site"><a rel="nofollow" href="/blog/{{$result->id}}" title="{{$result->name}}"><?php echo $result->name; ?></a></span>
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
<div id="secondary">
    <div class="cont-inner">
        <div class="list-wrap">
        <?php $i = $results->firstItem(); ?>
        @foreach($results as $key => $result)
            <section class="list-box">
                <div class="head">
                <div class="flag one"><span>{{$i}}</span></div>
                <ul class="count">
                    <li class="in">{{$result->rss_per_pc_in + $result->rss_per_sp_in}}</li>
                    <li class="out">{{$result->rss_per_pc_out + $result->rss_per_sp_out}}</li>
                </ul>
                    <h3><img src="{{$result->icon_url}}" alt="{{$result->name}}" width="16" height="16"><a class="blog-count" onmousedown="return blog_count(this);" href="{{$result->site_url}}" blog_id="{{$result->id}}" title="{{$result->name}}" target="_blank">{{$result->name}}</a></h3> 
                </div>
                <div class="image">
                    <span class="thum"><a class="blog-count" onmousedown="return blog_count(this);" href="{{$result->site_url}}" blog_id="{{$result->id}}" title="{{$result->name}}" target="_blank"><?php echo $result->img ?></a></span>
                    <span class="btn"><a rel="nofollow" href="/blog/{{$result->id}}" title="{{$result->name}}"><img class="ovr" src="http://matomeantena.com/assets/matomeantena/img/parts/listbtn.png?1503389174" alt="{{$result->name}}"></a></span>
                </div>
                <ul class="list">
                <?php $j = 1;
                ?>

                @foreach($rss_sites as $key => $rss_site)
                    <?php if($result->id == $rss_site->rss_id && $j < 6) {
                            if (($j%2) == 0 ) {
                    ?>
                    <li><a class="feed-click" onmousedown="return click_out({{$result->id}});" href="{{$rss_site->article_url}}" title="{{$rss_site->title}}" rel="nofollow" target="_blank">{{$rss_site->title}}</a></li>
                <?php 
                            }
                            else{
                 ?>
                    <li class="even"><a class="feed-click" onmousedown="return click_out({{$result->id}});" href="{{$rss_site->article_url}}" title="{{$rss_site->title}}" rel="nofollow" target="_blank">{{$rss_site->title}}</a></li>
                    <?php 
                            }
                        $j++;
                        } else{
                            continue;
                        }
                 ?>
                @endforeach
                </ul>
            </section>
            <?php $i++ ; ?>
        @endforeach
        </div>
    </div>
</div>
@endsection
