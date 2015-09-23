<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\models;

use Yii;
use jlorente\tagable\db\Tag;
use jlorente\tagable\exceptions\SaveException;
use yii\helpers\ArrayHelper;

/**
 * Trait to be used by the tagable model on the class exposed in the form where 
 * the tags are selected.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
trait TagableFormTrait {

    use TagableTrait;

    /**
     *
     * @var int[] 
     */
    public $tagIds;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['tagIds', 'safe']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'tagIds' => Yii::t('jlorente/tagable', 'Tags')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function save($runValidation = true, $attributeNames = null) {
        if ($runValidation && $this->validate($attributeNames) === false) {
            return false;
        }
        $trans = Yii::$app->db->beginTransaction();
        try {
            if (parent::save(false, $attributeNames) === false) {
                throw new SaveException($this);
            }
            $this->unlinkAll('tags', true);
            foreach ($this->tagIds as $tagId) {
                $tag = Tag::getOrCreate($tagId);
                $this->link('tags', $tag);
            }
            $trans->commit();
            return true;
        } catch (\Exception $ex) {
            $trans->rollback();
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function populateRecord($record, $row) {
        parent::populateRecord($record, $row);
        $record->tagIds = ArrayHelper::getColumn($record->tags, 'id');
    }

}
