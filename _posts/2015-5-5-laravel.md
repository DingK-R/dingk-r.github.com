---
layout: post
title:  "Laravel 分享"
date:   2015-5-5 14:31:00
categories: coding
---

##基本介绍
####1. 依赖管理
[Composer](http://www.phpcomposer.com/what-is-composer/) [Packagist](https://packagist.org/)
####2. 路由 REST
<!--![](http://i1.tietuku.com/a2154e28a87da672.jpg)-->

	Route::get('/', 'WelcomeController@index');
	Route::get('about', 'PagesController@about');
	Route::get('contact', 'PagesController@contact');
	Route::resource('articles', 'ArticlesController');
####3. 迁移与数据填充
<!--![](http://i1.tietuku.com/91832f8256584d8b.jpg)-->
	public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at');
        });
    }
####4. Eloquent
<!--![](http://i1.tietuku.com/09360b6d6992a550.jpg)-->
	public function store(CreateArticleRequest $request)
    {
        Article::create($request->all());

        return redirect('articles');

    }
####5. Blade模版
<!--![](http://i1.tietuku.com/caa96298e70ae477.jpg)-->

	@extends('app')
	@section('content')

    <h1>Write a New Article</h1>

    <hr/>

    {!! Form::open(['url' => 'articles']) !!}
        @include('articles.form', ['submitButtonText' => 'Add Article'])
    {!! Form::close() !!}

    @include('errors.list')
	@stop
##核心思想
####1. 依赖注入 (Dependency Injection)
####2. 控制反转容器 (Inversion of control)


####PS:
社区 [PHPub](https://phphub.org)  [Golaravel](http://wenda.golaravel.com/) [Laravel](lavavel.com) [Laracasts](https://laracasts.com)
