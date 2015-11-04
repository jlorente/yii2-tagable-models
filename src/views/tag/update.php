<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jlorente\tagable\db\Tag */

$this->title = Yii::t('jlorente/tagable', 'Update Tag') . ' #' . $model->id;
?>
<div class="backend-container tag-model tag-update">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>