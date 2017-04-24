<p align="center">
copywriting-correct
</a>

<p align="center">中英文文案排版指北纠正器。</p>

## 描述
本系统基于 [中文文案排版指北（简体中文版）](https://github.com/mzlogin/chinese-copywriting-guidelines) 进行纠正。

## 安装
```
//安装开发中版本
composer require ricoa/copywriting-correct:dev-master
```

## 使用
```php
<?php
require_once 'vendor/autoload.php';

use Ricoa\CopyWritingCorrect\CopyWritingCorrectService;

$service=new CopyWritingCorrectService();

$text=$service->correct('在LeanCloud上，数据存储是围绕AVObject进行的。');


```

## 已实现
### 空格
1. CJK 字符与半角字符（例如英文字符，数字等）间添加空格。
2. 数字后面跟着英文字符则在数字后添加空格（适用于数字+单位，例如 1 GB）。
3. 全角标点与其他字符之间不加空格
4. 希腊字母与 CJK 字符以及数字英文字符之间添加空格（不在指北内）。

### 标点符号
1. 不重复使用中文标点符号（仅！和？），重复时只保留第一个

### 全角和半角
1. 使用全角中文标点
2. 数字使用半角字符

### 名词
1. 专有名词使用正确的大小写（部分名词达成）


## 未实现

### 全角和半角
1. 遇到完整的英文整句、特殊名词，其內容使用半角标点