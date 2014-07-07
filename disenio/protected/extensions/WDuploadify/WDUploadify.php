<?php
class WDUploadify extends CInputWidget 
{
	/******* widget private vars *******/
	private $baseUrl			= null;
	private $jsFiles			= array(
									'/jquery.uploadify-3.1.min.js',
								);
	private $cssFiles			= array(
									'/uploadify.css',
								);		
	public $cssId = 'file_upload';	
    
    public $config = array();
								
	/**
	* Initialize the widget
	*/
	public function init()
	{
		//Publish assets
		$this->publishAssets();
		$this->registerClientScripts();
		parent::init();
	}
	
	/**
	* Publishes the assets
	*/
	public function publishAssets()
	{
		$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploadify-v3.1';
		$this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
	}
	
	/**
	* Registers the external javascript files
	*/
	public function registerClientScripts()
	{
		
		if ($this->baseUrl === '')
			throw new CException(Yii::t('Uploadify', 'baseUrl must be set. This is done automatically by calling publishAssets()'));
		
		//Register the main script files
		Yii::app()->clientScript->registerCoreScript('jquery');
		$cs = Yii::app()->getClientScript();
		foreach($this->jsFiles as $jsFile) {
			$uploadifyJsFile = $this->baseUrl . $jsFile;
			$cs->registerScriptFile($uploadifyJsFile, CClientScript::POS_HEAD);
		}
		
		// add the css
		foreach($this->cssFiles as $cssFile) {
			$uploadifyCssFile = $this->baseUrl . $cssFile;
			$cs->registerCssFile($uploadifyCssFile);
		}
        
		//Register the widget-specific script on ready
		$js = $this->onloadJavascript();
		$cs->registerScript('uploadify'.$this->getId(), $js, CClientScript::POS_READY);
	}
	
	protected function onloadJavascript()
	{
         $config = array(
            'swf'=>$this->baseUrl.'/uploadify.swf',
            'uploader' => $this->baseUrl.'/uploadify.php',
            'cancelImg'=>$this->baseUrl.'/cancel.png',
            'fileTypeDesc' => '选择上传文件',
            'sizeLimit'=>1024000,
        );
		$config = array_merge($config, $this->config);
		$config = CJavaScript::encode($config);
        
		$js = "$('#{$this->cssId}').uploadify($config);";
		return $js;
	}
   
   
}
