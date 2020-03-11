<?php
namespace arunsahlam\plugins\morrisjs;
use yii\base\InvalidConfigException;
use yii\base\InvalidArgumentException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 *
 * Chart renders a Morris.JS plugin widget.
 *
 */
class Chart extends Widget
{

	/**
	 * @var array the options for Morris.JS charts.
	 */
	public $options = [];

	/**
	 *
	 * @var array the HTML options for div element
	 */
	public $htmlOptions = [
		'style' => 'height: 250px;'
	];

	/**
	 * @var string the type of chart to display. The possible options are:
	 * - "Line" 
	 * - "Bar" 
	 * - "Area"
	 * - "Donut"
	 */
	public $type;

	const TYPE_AREA = 'Area';
	const TYPE_BAR = 'Bar';
	const TYPE_DONUT = 'Donut';
	const TYPE_LINE = 'Line';

	/**
	 * @var string[] An array of the TYPE_* constants defined in this class
	 */
	private static $types = [
		self::TYPE_AREA,
		self::TYPE_BAR,
		self::TYPE_DONUT,
		self::TYPE_LINE,
	];

	/**
	 * Initializes the widget.
	 * This method will register the bootstrap asset bundle. If you override this method,
	 * make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		$type = $this->type;

		if ($type === null){
			throw new InvalidConfigException("The 'type' option is required");			
		}

		if( !in_array($type, self::$types)) {
			throw new InvalidArgumentException("'type' is not a valid chart type!");
		}

		if (!isset($this->options['element'])) {
			$this->options['element'] = $this->getId();
		}
		$this->htmlOptions['id'] = $this->options['element'];

		$this->validateRequiredOptions($this->type);
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		parent::run();
		echo Html::tag('div', '', $this->htmlOptions);
		$this->registerPlugin($this->type);
	}

	/**
	 * 
	 * @param type $name
	 */
	protected function registerPlugin($name)
	{
		$view = $this->getView();
		MorrisjsAsset::register($view);

		if (isset($this->options['object_id'])) {
			$object_id = $this->options['object_id'];
			unset($this->options['object_id']);

			$options = Json::encode($this->options);

			$js = "var $object_id = new Morris.$name($options)";
		
			$view->registerJs($js);
		} else {
			$options = Json::encode($this->options);

			$js = "new Morris.$name($options)";
		
			$view->registerJs($js);
		}
	}

	/**
	 * Validate type
	 * 
	 * @param string $type
	 * @return boolean
	 */
	protected function validateType($type)
	{
		return in_array($type, self::$types);
	}

	/**
	 * Validate options
	 * 
	 * @param type $type
	 * @return type
	 */
	protected function validateRequiredOptions($type)
	{
		if (!isset($this->options['data'])) {
			throw new InvalidConfigException("The 'data' option is required");
		}

		if (!$type === self::TYPE_DONUT) {
			if (!isset($this->options['xkey'])) {
				throw new InvalidConfigException("The 'xkey' option is required");
			}

			if (!isset($this->options['ykeys'])) {
				throw new InvalidConfigException("The 'ykeys' option is required");
			}

			if (!isset($this->options['labels'])) {
				throw new InvalidConfigException("The 'labels' option is required");
			}
		}
	}

}
