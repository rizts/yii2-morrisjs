# yii2-Morrisjs

This Yii2 extension is a wrapper for Morris.js Graphic JavaScript Library to create good-looking charts 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ ./composer.phar require arunsahlam/yii2-morrisjs
```

## Usage

### Example of code
```php
use arunsahlam\plugins\morrisjs\Chart;

echo Chart::widget([
	/*
	 * Chart Types
	 *	Chart::TYPE_AREA
	 *	Chart::TYPE_BAR
	 *	Chart::TYPE_DONUT
	 *	Chart::TYPE_LINE
	 */
    'type' => Chart::TYPE_DONUT, 
    'options' => [],
    'htmlOptions' => [],
]);

```

## Morris.js usage

Go to [Olly Smith](https://morrisjs.github.io/morris.js/) for information.
