<?php
/**
* Yandex map extension for Yii 1.x
*
* @author disasterovich@mail.ru
* @site: diz-blog.com.ua
* @ license: GPL
*
*/

class YandexMap extends CWidget
    {
    public $visible=0;
    public $markers = array();
    public $params = array();
    public $default_params = array('visible'=>true,'zoom'=>13,'minzoom'=>8,'width'=>'420px','height'=>'210px','lat' => 45.300, 'lng' => 34.400,);

    // этот метод будет вызван внутри CBaseController::beginWidget()
    public function init()
        {
        //Дополним значениями по умолч.
        foreach ($this->default_params as $k=>$v)
            {
            if ( !isset($this->params[$k]) )
                {
                $this->params[$k] = $v;
                }
            }
        
        Yii::app()->clientScript->registerScript(0,
                'yandex_maps_markers='.CJSON::encode($this->markers).';'.
                'yandex_maps_params='.CJSON::encode($this->params).';',
                CClientScript::POS_READY
                );

        $this->publishAssets();

        parent::init();
        }

    // этот метод будет вызван внутри CBaseController::endWidget()
    public function run()
        {
        $this->render( 'yandexmap',array('params'=>$this->params) );
        }

    public function publishAssets()
        {
        $assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);
        if(is_dir($assets)) 
            {
            Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.1/?lang=ru_RU');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/yandexmap.js', CClientScript::POS_HEAD);
            } 
        else 
            {
            throw new Exception('Yandex map - Error: Couldn\'t find assets to publish.');
            }
        }
    }
