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

/**
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagDisplayer extends Widget {

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
        $html = $s = '';
        foreach ($this->model->tags as $tag) {
            $html .= $s . Html::a(Html::encode($tag->name), ['tag/view', 'id' => $tag->id], [
                        'class' => 'btn tag-sm',
                        'style' => 'background: ' . $tag->color . ';'
            ]);
            $s = ' ';
        }
        return $html;
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
