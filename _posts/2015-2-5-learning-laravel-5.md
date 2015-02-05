---
layout: post
title:  "Laravel 5 - Homestead"
date:   2015-02-05 16:07:00
categories: Code
---


1. 安装 [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](http://www.vagrantup.com/downloads.html)

2. 添加homestead
		
		vagrant box add laravel/homestead
		

3. 全局调用homestead

		composer global require "laravel/homestead=~2.0"

		PATH=~/.composer/vendor/bin:$PATH

        or

        vim .zshrc
        export PATH="/Users/user_name/.composer/vendor/bin:/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin"

	PS: homestead测试下是否正常
	
4. 根据环境编辑Homestead.yaml

		homestead edit
		
5. 生成ssh_key

		ssh-keygen -t rsa -C "you@homestead"
		
6. 设置共享目录

		folders 映射关系

7. 设置sites绑定域名，注意**映射的路径**是否在VM中**存在**


8. 修改本地host，绑定的IP和域名

9. 访问下看看是否正常吧



