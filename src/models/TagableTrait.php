<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\models;

use jlorente\tagable\db\Tag;

/**
 * Trait to be used by the model that is going the be tagable.
 * 
 * @property Tag[] $tags The tags that the tagable model has.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
trait TagableTrait {

    /**
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getTags() {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                        ->viaTable(Tag::relationTableName(), [
                            'model_id' => 'id',
                            'class_name' => static::className()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function link($name, $model, $extraColumns = []) {
        parent::link($name, $model, array_merge($extraColumns, [
            'class_name' => static::className()
        ]));
    }

}
