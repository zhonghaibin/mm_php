<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@4/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/node-pace-progress@1/themes/white/pace-theme-flash.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7/dist/sweetalert2.min.css">
    <link href="{{asset('css/frontend.custom.css')}}" rel="stylesheet">
@yield('css')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ route('home')}}" class="navbar-brand">
                        <b>蜜蜜妈妈</b></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse " id="navbar-collapse">
                    <form class="navbar-form navbar-left" role="search" action="{{ route('search') }}" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" name="keyword"
                                   placeholder="搜索">
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        @foreach($nav_list as $nav_v)
                            @if($nav_v->type === \App\Models\Nav::TYPE_MENU)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ $nav_v->name }}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach($category_list as $category_v)
                                            <li>
                                                <a href="{{ route('category',$category_v->id) }}">{{ $category_v->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @elseif($nav_v->type === \App\Models\Nav::TYPE_ARCHIVE)
                                <li>
                                    <a href="{{ route('archive') }}">{{ $nav_v->name }}</a>
                                </li>
                            @elseif($nav_v->type === \App\Models\Nav::TYPE_EMPTY)
                                @if(!blank($nav_v->children))
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $nav_v->name }}
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach( $nav_v->children as $nav_son )
                                                <li>
                                                    <a href="{{ $nav_son->url }}">{{ $nav_son->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $nav_v->url  }}">{{ $nav_v->name }}</a>
                                    </li>
                                @endif
                            @elseif($nav_v->type === \App\Models\Nav::TYPE_PAGE || \App\Models\Nav::TYPE_LINK)
                                <li class="">
                                    <a href="{{ $nav_v->url  }}">{{ $nav_v->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="blank-div"></div>
    <div class="content-wrapper">
        <div class="container" id="main">
            <section class="content">
                <div class="row">
                    @yield('content')
                    <div class="col-md-4 hidden-xs">
                        <div class="row">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <i class="fa fa-arrow-up"></i>

                                    <h3 class="box-title">热门文章</h3>
                                </div>
                                <div class="box-body">
                                    <ul class="list-group list-group-unbordered">
                                        @foreach($top_article_list as $article)
                                            <li class="list-group-item">
                                                <i class="fa fa-hand-o-right"></i>
                                                <a href="{{route('article',$article->id)}}"
                                                   class="title-link">{{$article->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <i class="fa fa-tags"></i>

                                    <h3 class="box-title">标签云</h3>
                                </div>
                                <div class="box-body">
                                    @foreach($article_tag_list as $t_list)
                                        <a href="{{route('tag',$t_list->id)}}"
                                           @switch(rand(0,4)) @case(0)class="tag btn btn-flat btn-xs bg-black"
                                           @break @case(1)class="tag btn btn-flat btn-xs bg-olive"
                                           @break @case(2)class="tag
                                            btn btn-flat btn-xs bg-blue"
                                           @break @case(3)class="tag btn btn-flat btn-xs bg-purple"
                                           @break @default class="tag btn btn-flat btn-xs
                                            bg-maroon" @endswitch>{{$t_list->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <i class="fa fa-search"></i>
                                    <h3 class="box-title">全站搜索</h3>
                                </div>
                                <div class="box-body">
                                    <form action="{{route('search')}}" method="get">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="keyword" placeholder="搜索">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <strong>Copyright &copy; {{date('Y')}}
                <a class="title-link" href="/">蜜蜜妈妈</a>.</strong> All rights reserved.
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/node-pace-progress@1/pace.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/return-top@1/dist/x-return-top.min.js" left="90%" bottom="5%"
        text="返回顶部"></script>
@yield('js')
<script>
    // 兼容小屏幕
    $(function () {
        if (screen.width < 768) {
            $("div#main").removeClass("container");
        }

    });
</script>
</body>

</html>
