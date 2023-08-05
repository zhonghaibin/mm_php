@extends('layouts.backend')
@section('title','控制台 - 标签管理')
@section('css')
    <script>var editTagUrl = "{{route('article_tag_edit')}}"</script>
@stop
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>标签管理
                <small>蜜蜜妈妈</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard_home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li><a href="#">内容管理</a></li>
                <li class="active">标签管理</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">全部标签</h3>
                            <span>共{{ $tags->total() }}个</span>
                            <form action="{{ route('article_tag_search') }}" method="get" style="display: inline-flex"
                                  class="pull-right">
                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="keyword" class="form-control" placeholder="搜索">

                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>标签名</th>
                                    <th>标识</th>
                                    <th>文章数</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!blank($tags))
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td><input type="checkbox" value="{{$tag->id}}" name="tid" class="i-checks">
                                            </td>
                                            <td>{{$tag->name}}</td>
                                            <td>
                                                {{$tag->flag}}
                                            </td>
                                            <td>
                                                {{$tag->article_count}}
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-green editTag">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>&nbsp;&nbsp;
                                                <a href="javascript:void(0)" class="text-red delTag">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td valign="top" colspan="5">表中数据为空</td>
                                    </tr>
                                @endif
                                </tbody>


                            </table>
                            <form id="deleteForm" style="display: none;" action="{{route('article_tag_destroy')}}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="tid" id="deleteId">
                            </form>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectAll('tid')">全选</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectEmpty('tid')">全不选</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectReverse('tid')">反选</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-flat"
                                   id="delSelectedTag">删除选定</a>
                            </div>
                            @if(request()->has('keyword'))
                                {{ $tags->appends(['keyword' => request()->input('keyword')])->links('vendor.pagination.adminlte') }}
                            @else
                                {{ $tags->links('vendor.pagination.adminlte') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('errors.validator')
                    <form role="form" method="POST" action="{{route('article_tag_update')}}" id="editTagForm"
                          style="display:none;">
                        @csrf
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">编辑标签</h3>
                            </div>
                            <div class="box-body">
                                <input type="hidden" name="id" id="editId">
                                <div class="form-group {{$errors->has('edit_name')?'has-error':''}}">
                                    <label for="editName">标签名：</label>
                                    <input type="text" class="form-control" name="edit_name" id="editName"
                                           placeholder="请输入标签名" value="{{ old('edit_name')?old('edit_name'):'' }}">
                                    @if ($errors->has('edit_name'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('edit_name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('edit_flag')?'has-error':''}}">
                                    <label for="flag">标识：</label>
                                    <input type="editFlag" class="form-control" name="edit_flag" id="editFlag"
                                           placeholder="请输入标签标识" value="{{ old('edit_flag')?old('edit_flag'):'' }}">
                                    @if ($errors->has('edit_flag'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('edit_flag') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success btn-flat">提交</button>
                            </div>
                        </div>
                    </form>
                    <form role="form" method="POST" action="{{route('article_tag_store')}}" id="createTagForm">
                        @csrf
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">新建标签</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                    <label for="name">标签名：</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入标签名"
                                           value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('flag')?'has-error':''}}">
                                    <label for="flag">标识：</label>
                                    <input type="text" class="form-control" name="flag" id="flag" placeholder="请输入标签标识"
                                           value="{{old('flag')}}">
                                    @if ($errors->has('flag'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('flag') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success btn-flat">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@stop
