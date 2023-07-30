@extends('layouts.frontend')
@section('title', '蜜蜜妈妈')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="col-md-8">
        @foreach($articles as $article)
            <div class="box box-solid">
                <div class="box-body article-body">

                    <a href="{{route('article',$article->id)}}" class="title-link">
                        <h3>
                            @if($article->is_top)
                                🔥&nbsp;
                            @endif
                            {{ $article->title }}
                        </h3>
                    </a>
                    <div class="small m-b-xs">
                        <strong>{{$article->author}}</strong>&nbsp;&nbsp;<span class="text-muted"><i
                                class="fa fa-clock-o"></i>&nbsp;最后更新于&nbsp;{{\App\Helpers\Extensions\Tool::transformTime($article->feed->updated_at)}}&nbsp;</span>
                    </div>
                    <div class="description">
                        <p style="word-wrap:break-word;"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>标签：</h5>
                            @foreach($article->tags as $tag)
                                <a href="{{route('tag',$tag->id)}}"
                                   @switch(rand(0,4)) @case(0)class="tag btn btn-flat btn-xs bg-black"
                                   @break @case(1)class="tag btn btn-flat btn-xs bg-olive"
                                   @break @case(2)class="tag btn btn-flat btn-xs bg-blue"
                                   @break @case(3)class="tag btn btn-flat btn-xs bg-purple"
                                   @break @default class="tag btn btn-flat btn-xs bg-maroon" @endswitch><i
                                        class="fa fa-tag"></i>&nbsp;{{$tag->name}}</a>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="small text-right">
                                <h5>状态：</h5>
                                    <i class="fa fa-eye"> </i> {{$article->click}} 浏览
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a href="{{route('article',$article->id)}}" class="btn btn-flat bg-black tag"><i
                                        class="fa fa-eye"></i> 阅读全文</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $articles->links('vendor.pagination.simple-default') }}
    </div>
@stop
