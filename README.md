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
- 海问香粼妖
- 万两 墨拓人
- 秋落木 辉妖

> 运行环境要求 PHP5.6 以上。

## 安装

使用 composer 安装

```
composer require fdd/php-helper (暂定)
```

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
