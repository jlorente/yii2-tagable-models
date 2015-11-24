<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\assets;

use yii\web\AssetBundle;

/**
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagFilterAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/jlorente/yii2-tagable-models/src/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/tag-filter.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
