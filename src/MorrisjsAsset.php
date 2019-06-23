<?php
namespace arunsahlam\plugins\morrisjs;

use yii\web\AssetBundle;

class MorrisjsAsset extends AssetBundle {
	
	public $sourcePath = '@bower/morrisjs';

	public $depends = [
		'yii\web\YiiAsset',
		'yii\web\JqueryAsset',
		'arunsahlam\plugins\raphaeljs\RaphaeljsAsset'
	];
	
	public function init()
	{
		parent::init();

		$this->js = YII_DEBUG ? ['morris.js'] : ['morris.min.js'];

		$this->css = [
			'morris.css'
		];
	}
}
