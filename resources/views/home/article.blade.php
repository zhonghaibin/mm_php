@extends('layouts.frontend')
@section('title', $article->title)
@section('keywords', $article->keywords)
@section('description', $article->description)
@section('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/combine/npm/prismjs@1/themes/prism-okaidia.min.css,npm/prismjs@1/plugins/toolbar/prism-toolbar.min.css,npm/prismjs@1/plugins/previewers/prism-previewers.min.css,npm/prismjs@1/plugins/command-line/prism-command-line.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/social-share.js@1/dist/css/share.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.css">
@stop
@section('content')
    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <a href="{{route('home')}}" class="btn bg-black btn-flat btn-sm tag"><i
                                    class="fa fa-undo"></i>&nbsp;返回</a>
                        </div>
                        <div class="pull-right">
                            @foreach($article->tags as $tag)
                                <a href="{{route('tag',$tag->id)}}"
                                   @switch(rand(0,4)) @case(0)class="tag btn btn-flat btn-xs bg-black"
                                   @break @case(1)class="tag btn btn-flat btn-xs bg-olive"
                                   @break @case(2)class="tag btn btn-flat btn-xs bg-blue"
                                   @break @case(3)class="tag btn btn-flat btn-xs bg-purple"
                                   @break @default class="tag btn btn-flat btn-xs bg-maroon" @endswitch target="_blank"><i
                                        class="fa fa-tag"></i>&nbsp;{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center article-title">
                            <h2>
                                {{$article->title}}
                            </h2>
                        </div>
                        <div class="text-center article-meta">
                            <i class="fa fa-clock-o"></i> {{\App\Helpers\Extensions\Tool::transformTime($article->created_at)}}
                            ⋅
                            <i class="fa fa-eye"> </i> {{$article->click}}
                        </div>
                        <div class="markdown-body article-content" style="word-wrap:break-word;">
                            {!! $article->feed->html !!}
                        </div>
                            <div class="text-center">
                                <a class="btn bg-red" data-toggle="collapse" href="#reward" role="button"
                                   aria-expanded="false" aria-controls="reward">赏</a>
                            </div>
                            <div class="collapse text-center " id="reward">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">
                                        <img  src="{{asset('images/buymeacoffee.jpg')}}" alt="微信打赏"  class="img-responsive">
                                        <span class="help-block">微信打赏</span></div>
                                    <div class="col-md-4"></div>
                                </div>

                            </div>
                            <div class="hr-line-dashed"></div>

                        <div class="social-share text-center"
                             data-disabled="google,twitter, facebook, diandian,linkedin,douban"></div>
                        <div class="copyright_div">
                            <ul class="copyright">
                                <li><strong>本文作者：</strong>{{$article->author}}</li>
                                <li><strong>本文链接：</strong> {{route('article',$article->id)}}
                                </li>
                                <li><strong>版权声明： </strong>本站所有文章均来自互联网，如有侵权，请联系作者删除
                                </li>
                            </ul>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="prev-next">
                            <div class="prev pull-left">
                                @if(blank($prev))
                                @else
                                    <a href="{{route('article',$prev['id'])}}" class="btn bg-black btn-flat btn-block"
                                       title="{{ $prev->title }}">
                                        <i class="fa fa-arrow-left"></i>&nbsp;{{ \App\Helpers\Extensions\Tool::subStr($prev['title'],0,10,true)}}
                                    </a>
                                @endif
                            </div>
                            <div class="next pull-right">
                                @if(blank($next))
                                @else
                                    <a href="{{route('article',$next['id'])}}" class="btn bg-black btn-flat btn-block"
                                       title="{{ $next->title }}">
                                        {{\App\Helpers\Extensions\Tool::subStr($next['title'],0,10,true)}}&nbsp;<i
                                            class="fa fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script
        src="https://cdn.jsdelivr.net/combine/npm/prismjs@1,npm/prismjs@1/components/prism-markup-templating.min.js,npm/prismjs@1/components/prism-markup.min.js,npm/prismjs@1/components/prism-css.min.js,npm/prismjs@1/components/prism-clike.min.js,npm/prismjs@1/components/prism-javascript.min.js,npm/prismjs@1/components/prism-docker.min.js,npm/prismjs@1/components/prism-git.min.js,npm/prismjs@1/components/prism-json.min.js,npm/prismjs@1/components/prism-less.min.js,npm/prismjs@1/components/prism-markdown.min.js,npm/prismjs@1/components/prism-nginx.min.js,npm/prismjs@1/components/prism-php.min.js,npm/prismjs@1/components/prism-php-extras.min.js,npm/prismjs@1/components/prism-sass.min.js,npm/prismjs@1/components/prism-sql.min.js,npm/prismjs@1/components/prism-yaml.min.js,npm/prismjs@1/components/prism-bash.min.js,npm/prismjs@1/components/prism-ini.min.js,npm/prismjs@1/plugins/toolbar/prism-toolbar.min.js,npm/prismjs@1/plugins/previewers/prism-previewers.min.js,npm/prismjs@1/plugins/autoloader/prism-autoloader.min.js,npm/prismjs@1/plugins/command-line/prism-command-line.min.js,npm/prismjs@1/plugins/normalize-whitespace/prism-normalize-whitespace.min.js,npm/prismjs@1/plugins/keep-markup/prism-keep-markup.min.js,npm/prismjs@1/plugins/show-language/prism-show-language.min.js,npm/prismjs@1/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/social-share.js@1/dist/js/jquery.share.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.js"></script>
    <script>
        $(function () {
            let article_pre = $(".article-content pre");
            article_pre.each(function () {
                let class_val = $(this).attr('class');
                if (!class_val) {
                    $(this).addClass('language-code');
                }
            });
            let article_img = $(".article-content img");
            article_img.each(function () {
                $(this).addClass("img-responsive");
                let src = $(this).attr("src");
                if (!$(this).parent().is("a")) {
                    $(this).wrap("<a href='" + src + "'></a>")
                }
                $(this).parent().attr("data-fancybox", "article-content");
            });
        });
    </script>
@stop
