---
layout: post
title: "PHP_Reference"
description: ""
category: 
tags: [PHP]
---
{% include JB/setup %}

**关于PHP的传值引用**
{% highlight php %}
$a = 'one';

$b = &$a;
{% endhighlight %}
`$a`和`$b` 都指向同一个地址，两个变量共享同一个内存存储区域，所以值是相同的。

{% highlight php %}
function foo(&$arg1, $arg2) { 
	$arg1 += 1;
	$arg2 += 1;
}
$a = 10;
$b = 20;
foo($a, $b);

echo $a;
echo $b;
{% endhighlight %}
foo的第一个参数被设置为引用，实际上是引用$a，对$a的原始地址的值+1，所以当最后输出$a的时候值为11，而第二个参数的作用域是在函数里，当在外部输出$b的时候则是原有$b的值。

作为菜鸟不知道这么理解有没有问题，如果有错误，欢迎留言指出。
