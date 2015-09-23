<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\widgets;

use yii\base\Widget;
use yii\widgets\ActiveForm;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use jlorente\tagable\db\Tag;

/**
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagSelector extends Widget {

    /**
     *
     * @var ActiveForm
     */
    protected $form;

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
        if ($this->form === null) {
            throw new InvalidConfigException('form property must be provided on class instantiation');
        }
        if ($this->model === null) {
            throw new InvalidConfigException('model property must be provided on class instantiation');
        }
    }

    /**
     * @inheritdoc
     */
    public function run() {
        echo $this->form->field($this->model, 'tagIds')->widget(Select2::className(), [
            'data' => ArrayHelper::map(Tag::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => Yii::t('jlorente/tagable', 'Select a tag')],
            'pluginOptions' => [
                'multiple' => true,
                'allowClear' => true,
                'tags' => true
            ],
        ]);
    }

    /**
     * 
     * @param ActiveForm $form
     */
    public function setForm(ActiveForm $form) {
        $this->form = $form;
    }

    /**
     * 
     * @return ActiveForm
     */
    public function getForm() {
        return $this->form;
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
