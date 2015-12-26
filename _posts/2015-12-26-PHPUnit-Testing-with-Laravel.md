---
layout: post
title:  "Phpunit Testing With Laravel"
date:   2015-12-26 18:34:00
categories: Code
---

### 环境说明

> Mac OS X 10.11.2
> 
> Laravel 5.2
> 
> PHPUnit 4.8.21
> 
> Homestead v0.2.7
> 
> PHPStrom 10

### 单元测试的意义

对结果进行判断，测试是否是我们想要的预期结果，让我们的程序更加健壮。

### 介绍

- 安装Laravel
- 安装方式可以使用[composer](https://getcomposer.org/)，也可以使用[laravel](https://laravel.com/docs/5.2/installation)安装器。

``` 
╰$ laravel new testing
Crafting application...
Application ready! Build something amazing.
╰$ sudo composer install
```

- 查看基本信息
  - 在项目中的根目录查看composer.json文件是否require了[phpunit](https://packagist.org/packages/phpunit/phpunit)。


- phpunit.xml 告诉PHPUnit该如何运行
  
  ``` xml
  <?xml version="1.0" encoding="UTF-8"?>
  <phpunit backupGlobals="false"
           backupStaticAttributes="false"
           bootstrap="bootstrap/autoload.php"
           colors="true"
           convertErrorsToExceptions="true"
           convertNoticesToExceptions="true"
           convertWarningsToExceptions="true"
           processIsolation="false"
           stopOnFailure="false">
      <testsuites>
          <testsuite name="Application Test Suite">
              <directory>./tests/</directory>
          </testsuite>
      </testsuites>
      <filter>
          <whitelist>
              <directory suffix=".php">app/</directory>
          </whitelist>
      </filter>
      <php>
          <env name="APP_ENV" value="testing"/>
          <env name="CACHE_DRIVER" value="array"/>
          <env name="SESSION_DRIVER" value="array"/>
          <env name="QUEUE_DRIVER" value="sync"/>
      </php>
  </phpunit>
  <!-- 参数属性说明 -->
  <!-- backupStaticAttributes 关闭备份备份所有已声明的类的静态属性的值 防止污染 -->
  <!-- backupGlobals 关闭全局变量的备份 -->
  <!-- bootstrap 自动加载-->
  <!-- colors Terminal中输出是否带颜色 -->
  <!-- convertErrorsToExceptions convertNoticesToExceptions convertWarningsToExceptions 错误信息级别-->
  <!-- processIsolation 每个测试是否运行在单独的PHP程序里 -->
  <!-- stopOnFailure 第一个错误或者失败就停止执行 -->
  <!-- testsuites 需要测试的目录 -->
  <!-- php 设置laravel的全局变量 主要是配置信息 -->
  ```

### 动手写个测试

实际上Laravel已经默认存在一个ExampleTest了，所以我们直接运行一下看下效果，在运行前如果我们本机没有安装phpunit可以直接调用vendor/bin/phpunit。

``` 
╰$ phpunit
PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

.

Time: 3.94 seconds, Memory: 12.75Mb

OK (1 test, 2 assertions)
```

看就是这么简单，说明我们的测试运行成功。那具体ExampleTest做了什么呢？

``` php
<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
}
```

访问我们项目的根目录并且检查输出内容中是否存在 **Laravel 5** 这个字符串，如果 **/** 这个路由不存在会访问失败的，所以确认下路由中是否定义了。

### 让我们了解更多的测试方法

``` php
<?php
public function testBasicExample()
{
  	// 1. 访问home page
    $this->visit('/');
    // 2. 检测是否含有Click Me的a链接 并点击跳转
    $this->click('Click Me');
    //3. 查找跳转后 内容中是否存在Hello PHPUnit
    $this->see('Hello PHPUnit');
    //4. 判断当前url是否为 /test
    $this->seePageIs('/test');
}
```

- 当使用click方法的时候会检测页面中是否存在Click Me的字符串，这里包括检测标签元素属性id, name
- 整个流程是在模拟一个访问行为，打开页面->点击->点击后的内容,对这一些列的行为进行检测

以上我们简单介绍了Laravel的应用测试，接下来介绍在工作流中的更多用法

### 工作流

现在我们有个关于产品的model需要测试, tests/unit/ProductTest.php

``` php
<?php

use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
  	function testAProductHasName()
  	{
  		$product = new Product('Fallout 4');
      	$this->assertEquals('Fallout 4', $product->name());
	}
}
```

- 测试用例可以继承TestCase ，也可以继承PHPUnit_Framework_TestCase。
- 对于命名，可以是任意形式的命名规则，下划线，驼峰，目的只有一个，让别人知道这个测试的作用是什么，因为你的项目在给别人用的使用，如果源码有改动，运行测试用例的时候可能会报错，我们应该提供详细准确的信息告诉测试人员当前模块是测试那部分功能的。

运行

``` 
╰$ ./vendor/bin/phpunit tests/unit/ProductTest.php
```

- 指定要运行的文件，默认tests目录下所有都会运行

``` 
PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

PHP Fatal error:  Class 'App\Product' not found in /testing/tests/unit/ProductTest.php on line 9

Fatal error: Class 'App\Product' not found in /testing/tests/unit/ProductTest.php on line 9
```

- 报错说明没有Product这个文件，接下来在App目录下创建一个Product.php

``` php
<?php

namespace App;

class Product
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }
}

```

``` 
╰$ ./vendor/bin/phpunit tests/unit/ProductTest.php
PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

.

Time: 3.25 seconds, Memory: 10.75Mb

OK (1 test, 1 assertion)
```

- 测试通过

有产品就有价格，接下来我们对价格进行测试

``` php
<?php

use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    function testProductHasName()
    {
        $product = new Product('Fallout 4');
        $this->assertEquals('Fallout 4', $product->name());
    }

    function testProductHasCost()
    {
        $product = new Product('Fallout 4', 59);
        $this->assertEquals(45, $product->cost());
    }
}

```

在测试`testProductHasName()`的时候我们由于没有定义`name()`方法导致报错，这里我们应该注意定义cost方法

``` php
<?php

namespace App;

class Product
{
    private $name;

    private $cost;

    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function name()
    {
        return $this->name;
    }

    public function cost()
    {
        return $this->cost;
    }
}

```

- 注意构造函数需要2个参数，我们应**添加**`testProductHasName()`中实列时候的**cost参数**

``` php
<?php

use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    function testProductHasName()
    {
        $product = new Product('Fallout 4', 59);
        $this->assertEquals('Fallout 4', $product->name());
    }

    function testProductHasCost()
    {
        $product = new Product('Fallout 4', 59);
        $this->assertEquals(59, $product->cost());
    }
}

```



``` 
╰$ ./vendor/bin/phpunit tests/unit/ProductTest.php
PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

.

Time: 3.25 seconds, Memory: 10.75Mb

OK (2 tests, 2 assertions)
```

仔细看下是不是有很多相似之处?

``` php
$product = new Product('Fallout 4', 59);
```

PHPUnit 提供了`setUp()`方法，测试类的每个测试方法都会运行一次 `setUp()` 这样我们就方便的初始化对象了

``` php
<?php

use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    protected $product;

    public function setUp()
    {
        $this->product = new Product('Fallout 4', 59);
    }

    function testProductHasName()
    {
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    function testProductHasCost()
    {
        $this->assertEquals(59, $this->product->cost());
    }
}

```



### 总结

使用PHPUnit让我们的程序更有保障，也让项目变得更加健壮。后面我会继续将后面部分的分享出来。

- 更多的测试方法
- 测试Eloquent
- 测试数据库连接
