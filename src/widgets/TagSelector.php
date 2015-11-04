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
use Yii;
use jlorente\tagable\models\TagableFormInterface;

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
     * @var TagableFormInterface
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
            'data' => ArrayHelper::map(Tag::find()->filterType($this->model->getTagAssociationType())->all(), 'id', 'name'),
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
     * @param TagableFormInterface $model
     */
    public function setModel(TagableFormInterface $model) {
        $this->model = $model;
    }

    /**
     * 
     * @return TagableFormInterface
     */
    public function getModel() {
        return $this->model;
    }

}
