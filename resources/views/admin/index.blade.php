@extends('layouts.backend')
@section('title','控制台 - 首页')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>首页
                <small>蜜蜜妈妈</small>
            </h1>
        </section>
        <section class="content container-fluid">
            @if (session('status'))
                <div class="callout callout-success">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> 您好!</h4>
                <p>{{ Auth::user()->name }}，欢迎访问蜜蜜妈妈</p>
                <p>在这里您可以尽情的书写你的创意</p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-6">

                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $articlesCount }}</h3>

                            <p>我的文章</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <a href="{{ route('article_manage') }}" class="small-box-footer">更多信息
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-6">

                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $pagesCount }}</h3>

                            <p>我的单页</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="{{ route('page_manage') }}" class="small-box-footer">更多信息
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">最新文章</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>标题</th>
                                    <th>时间</th>
                                </tr>
                                @foreach ($newArticles as $article)
                                    <tr>
                                        <td>{{$article->id}}.</td>
                                        <td><a class="text-black"
                                               href="{{route('article_edit',$article->id)}}">{{$article->title}}</a>
                                        </td>
                                        <td>
                                            {{$article->created_at}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            <a href="{{ route('article_manage') }}" class="btn btn-flat bg-blue pull-right">查看更多</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('js')

@stop
