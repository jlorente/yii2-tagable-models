<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\widgets\DetailView;
use custom\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jlorente\tagable\db\Tag */

$this->title = Yii::t('jlorente/tagable', 'Tag') . ' #' . $model->id;
?>
<div class="backend-container tag-model tag-view">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            [
                'attribute' => 'color',
                'format' => 'raw',
                'value' => Html::activeInput('color', $model, 'color', ['disabled' => true])
            ],
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by'
        ]
    ]);
    ?>
    <div class="col-sm-xs buttons">
        <?=
        Html::a(
                Yii::t('jlorente/tagable', 'Return'), ['index'], ['class' => 'btn btn-primary pull-right']
        )
        ?>
        <?=
        Html::a(
                Yii::t('jlorente/tagable', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-danger pull-right']
        )
        ?>
    </div>
</div>