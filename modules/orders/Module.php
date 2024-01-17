<?php

namespace orders;

use Yii;

/**
 * Module
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = '\orders\controllers';
    
    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config.php');
        $this->registerTranslations();
    }
    
    /**
     * registerTranslations
     *
     * @return void
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/orders/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/orders/messages',
            'fileMap' => [
                'modules/orders/common' => 'common.php',
                'modules/orders/header' => 'header.php',
                'modules/orders/body' => 'body.php',
                'modules/orders/mode' => 'mode.php',
            ],
        ];
    }
    
    /**
     * t
     *
     * @param  mixed $category
     * @param  mixed $message
     * @param  mixed $params
     * @param  mixed $language
     * @return void
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/orders/' . $category, $message, $params, $language);
    }
}