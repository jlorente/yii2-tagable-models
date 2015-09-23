<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable;

use yii\base\Module as BaseModule;
use Yii;

/**
 * Module class for the tagable-models module.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class Module extends BaseModule {

    /**
     *
     * @var string 
     */
    public $messageConfig = [];

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jlorente\tagable\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->setAliases([
            '@jlorenteTagable' => '@vendor/jlorente/yii2-tagable-models/src',
        ]);
        Yii::$app->i18n->translations['jlorente/tagable'] = $this->getMessageConfig();
    }

    /**
     * 
     * @return array
     */
    protected function getMessageConfig() {
        return array_merge([
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@jlorenteTagable/messages',
            'forceTranslation' => true
                ], $this->messageConfig);
    }

}
