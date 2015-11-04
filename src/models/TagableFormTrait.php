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

    /**
     *
     * @var int[] 
     */
    protected $tagIds;

    /**
     * @inheritdoc
     */
    public function tFormRules() {
        return array_merge(parent::rules(), [
            ['tagIds', 'safe']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function tFormAttributeLabels() {
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
            if (!empty($this->tagIds)) {
                foreach ($this->tagIds as $tagId) {
                    $tag = Tag::getOrCreate($tagId);
                    $this->link('tags', $tag);
                }
            }
            $trans->commit();
            return true;
        } catch (\Exception $ex) {
            $trans->rollback();
            throw $ex;
        }
    }

    /**
     * @inheritdoc
     */
    public static function populateRecord($record, $row) {
        parent::populateRecord($record, $row);
        $record->tagIds = ArrayHelper::getColumn($record->tags, 'id');
    }

    /**
     * @inheritdoc
     */
    public function getTagIds() {
        return $this->tagIds;
    }

    /**
     * @inheritdoc
     */
    public function setTagIds(array $ids) {
        $this->tagIds = $ids;
    }

}
