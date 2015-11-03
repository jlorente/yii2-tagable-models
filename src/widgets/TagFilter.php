<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagFilter extends Widget {

    /**
     *
     * @var ActiveRecord
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if ($this->model === null) {
            throw new InvalidConfigException('model property must be provided on class instantiation');
        }
    }

    /**
     * @inheritdoc
     */
    public function run() {
        echo Html::tag('div', Select2::widget([
                    'model' => $this->model,
                    'attribute' => 'tags',
                    'data' => ArrayHelper::map(Tag::find()->orderBy('slug ASC')->all(), 'slug', 'name'),
                    'language' => 'es',
                    'options' => [
                        'placeholder' => Yii::t('blog', 'Filtra por tag...'),
                        'data-url' => Url::to(['/daybyday/main/list'])
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false,
                    ],
                ]), [
            'class' => 'tag-select-filter'
        ]);
    }

    /**
     * 
     * @param ActiveRecord $model
     */
    public function setModel(ActiveRecord $model) {
        $this->model = $model;
    }

    /**
     * 
     * @return ActiveRecord
     */
    public function getModel() {
        return $this->model;
    }

}
