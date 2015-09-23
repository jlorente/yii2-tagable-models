<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use jlorente\tagable\db\Tag;

/* @var $this yii\web\View */
/* @var $model jlorente\tagable\db\Tag */

$this->title = Yii::t('jlorente/tagable', 'Tags');
?>
<div class="backend-container tag-model tag-index">
    <div class="header-button">
        <?=
        Html::a(
                Yii::t('jlorente/tagable', 'Create'), ['create'], ['class' => 'btn btn-warning pull-right']
        );
        ?>
    </div>
    <div class="">
        <?=
        GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => Tag::find()->orderBy('id DESC'),
                'pagination' => [
                    'pageSize' => 15,
                ],
                    ]),
            'columns' => [
                'id',
                'name',
                'slug',
                'color',
                'created_at:datetime',
                'updated_at:datetime',
                [
                    'class' => ActionColumn::className(),
                ],
            ]
        ]);
        ?>
    </div>
</div>