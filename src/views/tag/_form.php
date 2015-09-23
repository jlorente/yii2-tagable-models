<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model jlorente\tagable\db\Tag */
?>
<div class="tag-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'color')->input('color') ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('jlorente/tagable', 'Create') : Yii::t('jlorente/tagable', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
