---
layout: post
title:  "Homestead扩展xhprof"
date:   2015-03-17 10:47:49
categories: Code
---
### 问题：
	perl: warning: Setting locale failed.
	perl: warning: Please check that your locale settings:
    LANGUAGE = (unset),
    LC_ALL = (unset),
    LANG = "en_US.UTF-8"
	are supported and installed on your system.
### 解决：
	export LANGUAGE=en_US.UTF-8
	export LC_ALL=en_US.UTF-8
	export LANG=en_US.UTF-8
	export LC_TYPE=en_US.UTF-8
	
### 安装
	wget https://github.com/facebook/xhprof/archive/master.zip
	unzip master.zip
	cd xhprof-master/extension/
	phpize
	./configure
	make
	sudo make install
	
`如果不是master版本 Homestead环境编译会报错`

### php.ini
	[xhprof]
	extension=xhprof.so
	xhprof.output_dir="/var/tmp/xhprof"