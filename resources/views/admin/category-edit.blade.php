@extends('layouts.backend')
@section('title','控制台 - 栏目管理')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>栏目管理
                <small>蜜蜜妈妈</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard_home') }}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li><a href="{{ route('category_manage') }}">栏目管理</a></li>
                <li class="active">栏目管理</li>
            </ol>
        </section>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <form role="form" method="POST" action="{{route('category_update',$edit_category->id)}}"
                          id="editCategoryForm">
                        @csrf
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">编辑栏目</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                    <label for="name">栏目名：</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入栏目名称"
                                           value="{{old('name')?old('name'):$edit_category->name}}">
                                    @if ($errors->has('name'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">父级栏目</label>
                                    <select class="form-control {{$errors->has('parent_id')?'has-error':''}}"
                                            name="parent_id" id="parent_id">
                                        <option value="">请选择栏目</option>
                                        <option value="0" @if( 0==$edit_category->parent_id) selected @endif>一级栏目
                                        </option>
                                        @foreach($levelOne as $cate)
                                            <option value="{{ $cate->id }}"
                                                    @if( $cate->id==$edit_category->parent_id) selected @endif>{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('parent_id') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('flag')?'has-error':''}}">
                                    <label for="flag">标识：</label>
                                    <input type="text" class="form-control" name="flag" id="flag" placeholder="请输入栏目标识"
                                           value="{{old('flag')?old('flag'):$edit_category->flag}}">
                                    @if ($errors->has('flag'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('flag') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('sort')?'has-error':''}}">
                                    <label for="sort">排序权重：</label>
                                    <input type="text" class="form-control" name="sort" id="sort"
                                           placeholder="请输入数字，默认为0"
                                           value="{{old('sort')?old('sort'):$edit_category->sort}}">
                                    @if ($errors->has('sort'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('sort') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('keywords')?'has-error':''}}">
                                    <label for="keywords">关键词：</label>
                                    <input type="text" class="form-control" name="keywords" id="keywords"
                                           placeholder="请输入关键词"
                                           value="{{old('keywords')?old('keywords'):$edit_category->keywords}}">
                                    @if ($errors->has('keywords'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('keywords') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                    <label for="description">描述：</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                           placeholder="请输入描述"
                                           value="{{old('description')?old('description'):$edit_category->description}}">
                                    @if ($errors->has('description'))
                                        <span class="help-block "><strong><i
                                                    class="fa fa-times-circle-o"></i>{{ $errors->first('description') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success btn-flat">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">全部栏目</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th style="">#</th>
                                    <th>栏目名</th>
                                    <th>排序权重</th>
                                    <th>文章数</th>
                                    <th style="">操作</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td><input type="checkbox" value="{{$category->id}}" name="cid"
                                                   class="i-checks"></td>
                                        <td>{!! $category->name !!}</td>
                                        <td>
                                            {{$category->sort}}
                                        </td>
                                        <td>
                                            {{$category->article_count}}
                                        </td>
                                        <td>
                                            <a href="{{route('category_edit',$category->id)}}"
                                               class="text-green editCategory">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>&nbsp;&nbsp;
                                            <a href="javascript:void(0)" class=" delCategory text-red">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <form id="deleteForm" style="display: none;" action="{{route('category_destroy')}}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="cid" id="deleteId">
                            </form>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectAll('cid')">全选</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectEmpty('cid')">全不选</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat"
                                   onclick="selectReverse('cid')">反选</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-flat" id="delSelectedCategory">删除选定</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
