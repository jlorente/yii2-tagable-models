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
     * @return \jlorente\tagable\db\TagQuery
     */
    public function getTags() {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                        ->viaTable(Tag::relationTableName(), ['model_id' => 'id'], function($query) {
                            $query->andWhere([Tag::relationTableName() . '.class' => get_called_class()]);
                        });
    }

    /**
     * @inheritdoc
     */
    public function link($name, $model, $extraColumns = []) {
        if ($name === 'tags') {
            $extraColumns['class'] = get_called_class();
        }
        return parent::link($name, $model, $extraColumns);
    }

}
