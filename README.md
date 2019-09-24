

# [php-helper](https://github.com/fudanda/myadmin)

===============

[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.1-8892BF.svg)](http://www.php.net/)
[![License](https://poser.pugx.org/topthink/framework/license)](https://packagist.org/packages/topthink/framework)

适用于 [ThinkPHP5.1](http://thinkphp.cn) 快速生成 html/vue 打开即用的后台管理页面

## 主要新特性

* 创建权限数据库
* 创建静态文件
* laravel-mix 打包vue项目




> php-helper 的运行环境要求PHP7.1+。

## 安装

~~~
composer require fdd/php-helper
~~~
## 使用

创建html项目

~~~
php think  admin:init
~~~

创建Vue项目

~~~
php think  vue:init
~~~

更新
~~~
composer update fdd/php-helper
~~~

创建 model,contrell 等等(admin 为多应用名称,Article为控制器名，首字母需大写)
~~~
php think  curd:admin/Article
~~~



![](https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=4168864317,3199957741&fm=58&bpow=1121&bpoh=1600)

# PHP 助手类 封装常用方法

[![PHP Version](https://img.shields.io/badge/php-%3E%3D5.6-8892BF.svg)](http://www.php.net/)
[![License](https://poser.pugx.org/topthink/framework/license)](https://packagist.org/packages/topthink/framework)

对一些项目中常用的方法进行封装,减少 copy 代码的时间：：

- 奇衡三 基斯卡人
- 幽弥狂 雾妖
- 燃谷 兽族
- 幽若离 格勒莫赫人
- 大仓 萨库人
- 吧咕哒 蛰族
- 卡拉肖克玲 龙族
- 雷光 翼族
- 梅龙尼卡嘉 龙族
- 海问香 粼妖
- 万两 墨拓人
- 秋落木 辉妖

## 使用

###1.导出
//命名空间引用

`use Kuiba\Qihengsan\ExcelExport;`

//单个导出

```php
 $excelObj->exportTheExcel($filename, $xlsCell, $data);
```

//压缩导出

```php
 $res = array_chunk($data, 1000); $num = count($res);
 for ($i = 0; $i < $num; $i++) {
     $myres = $excelObj->exportTheExcelZip($filename, $xlsCell, $res[$i], $i + 1);
  }
 $excelObj->excelZip();
```

[![tobecontinued](tobecontinued.jpg)](https://github.com/fudanda/myadmin)