<?php

namespace app\modules\orders;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\orders\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config.php');
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/orders/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/orders/messages',
            'fileMap' => [
                'modules/orders/common' => 'common.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/orders/' . $category, $message, $params, $language);
    }
}