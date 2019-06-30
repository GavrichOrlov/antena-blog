<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta charset="shift_jis">
    <meta name="robots" content="noindex,follow,noarchive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META http-equiv="X-UA-Compatible" content="IE=Shift_JIS">
    <meta name="keywords" content="キーワード">
    <meta name="description" content="紹介文">
    <META name="GENERATOR" content="IBM WebSphere Studio Homepage Builder Version 11.0.0.0 for Windows">
    <META http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
    <meta name="robots" content="noarchive">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.rawgit.com/travist/seamless.js/master/build/seamless.child.js"></script> -->
    <!-- <script src="http://article-guide.xyz/public/js/search.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="http://article-guide.xyz/public/css/sp.css"> -->
    <!-- <link rel="stylesheet" href="http://article-guide.xyz/public/css/pc.css"> -->

    <link type="text/css" rel="stylesheet" href="/css/style.css"/>

    <link rel="alternate" type="application/rss+xml" title="RSS 総合" href="/index.rdf">
    <link rel="alternate" type="application/rss+xml" title="RSS VIP" href="/vip.rdf">
    <link rel="alternate" type="application/rss+xml" title="RSS ニュース" href="/news.rdf">

    <script type="text/javascript" src="/js/jquery-1.11.1.min.js?1503389174"></script>
    <script type="text/javascript" src="/js/jquery.mCustomScrollbar.concat.min.js?1503389174"></script>
    <script type="text/javascript" src="/js/jsviews.min.js?1467291647"></script>
    <script type="text/javascript" src="/js/common.js?1496914935"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-25642492-1', 'auto', {'name': 'mainTracker'});
      ga('mainTracker.require', 'displayfeatures');
      ga('mainTracker.require', 'linkid', 'linkid.js');
      ga('mainTracker.send', 'pageview');
      var mainTracker = true;
      var userTracker = false;
    </script>
    <title>野球｜ワロタあんてな</title>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  </head>
    
  <body id="{{$class}}">
    <header id="header">
      <div class="wrap">
        <h1><a href="/"><img src="http://matomeantena.com/assets/matomeantena/img/parts/logo.png?1503389174" alt="ワロタあんてな"></a></h1>
        <nav class="nav">
          <ul class="btn">
            <li class=""><a href="/blogs"><img src="http://matomeantena.com/assets/matomeantena/img/parts/i_star.png?1503389174" alt="登録ブログ一覧" title="登録ブログ一覧"></a></li>
            <li class=""><a href="/about"><img src="http://matomeantena.com/assets/matomeantena/img/parts/i_info.png?1503389174" alt="アバウト" title="アバウト"></a></li>
                    <li><a target="_blank" href="https://twitter.com/matomeantena"><img src="http://matomeantena.com/assets/matomeantena/img/parts/i_tw.png?1503389174" alt="ワロタあんてな ツイッター" title="ツイッター"></a></li>
                  </ul>
          <dl class="cat">
            <dt><span>&nbsp;</span></dt>
            <dd>
              <ul>
                @foreach($categories as $key => $category)
                    <?php if ($category->id == $active) {
                      ?>
                      <li class="active"><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
                    <?php 
                    } else { 
                    ?>
                      <li class=""><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
                    <?php 
                    }
                    ?>
                @endforeach
              </ul>
            </dd>
          </dl>
        </nav>
      </div>
    </header>
    @yield('content')

    @yield('footer')

    <?php if($active == 0){

    } else 
    {
    ?>
    <footer id="footer">
      <div class="wrap">
        <dl class="ranking">
          <dt><span>&nbsp;</span></dt>
          <dd>
            <ul>
              <?php
                for ($count = 1; $count < $results->lastPage() + 1; $count++) { 
                  if ($results->currentPage() == $count) {
              ?>
              <li class="active"><a href="/pagination/{{$active}}/{{$count}}">{{$count}}</a></li>
              <?php
                  } else {
              ?>
              <li class=""><a href="/pagination/{{$active}}/{{$count}}">{{$count}}</a></li>
              <?php
                  }
                }
              ?>
              </ul>
          </dd>
        </dl>
      </div>
    </footer>
    <?php
    }
    ?>
<script type="text/javascript">
  var dl_flage = 0;
  jQuery(document).ready(function($) {
      $('dl.cat').click(function() {
        if (dl_flage == 0) {
          this.getElementsByTagName('dd')[0].style = 'display: block';
          dl_flage = 1;
        } else {
          this.getElementsByTagName('dd')[0].style = 'display: none';
          dl_flage = 0;
        }
      });
  });
    function click_out(id){
      jQuery(document).ready(function($){
        $.ajax({
          method: 'get',
          url: '/register_out',
          data: {'id' : id},
          success: function(response){
              console.log(response); 
          },
          error: function(jqXHR, textStatus, errorThrown) {

          }
        });
      });
    }
  // document.write('<scr' + 'ipt type="text/javascript" charset="utf-8" src="http://adm.shinobi.jp/st/s.js"></scr' + 'ipt>');
  // if(document.documentElement.clientWidth > 51 || document.documentElement.clientHeight > 51){
  //   var acrrf;if(!acrrf){acrrf=0;}acrrf++;acr_rfd = document.referrer.replace(/ /g,"%20");
  //   acr_rfd = acr_rfd.replace(/&/g,"&amp;");
  //   if(acr_rfd){
  //     document.write('<SCRIPT TYPE="text/javascript" SRC="https://rranking5.ziyu.net/js.php?matomeantena&136&'+acrrf+'&'+acr_rfd.replace(/"|'|<|>/g,"")+'">'+ "<\/SCRIPT>");
  //   }
  // }
</script>
  </body>
</html>
