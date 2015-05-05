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
a. 快速构建API

	Route::get('/', 'WelcomeController@index');
	Route::get('about', 'PagesController@about');
	Route::get('contact', 'PagesController@contact');
	Route::resource('articles', 'ArticlesController');
####3. Migrations
<!--![](http://i1.tietuku.com/91832f8256584d8b.jpg)-->
a. 方便表的管理

b. 方便迁移，如本地环境搭建


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
a. 减少重复SQL, 缩短编码时间

b. 简单 create, save, find, all where ...

c. 减少数据库学习成本

缺点: 内存, 多表的复杂关系


	public function store(CreateArticleRequest $request)
    {
        Article::create($request->all());

        return redirect('articles');

    }
####5. Blade
<!--![](http://i1.tietuku.com/caa96298e70ae477.jpg)-->
a. 模版继承， 模版片段

b. 基础模型与实现, 更好的组织代码，减少重复

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
####1. 依赖注入 (Dependency Injection) 见代码
####2. 控制反转容器 (Inversion of control)


####PS: 社区 [PHPub](https://phphub.org)  [Golaravel](http://wenda.golaravel.com/) [Laravel](lavavel.com) [Laracasts](https://laracasts.com)
