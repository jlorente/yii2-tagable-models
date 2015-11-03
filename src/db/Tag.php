<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\db;

use jlorente\validators\ColorValidator;
use yii\behaviors\SluggableBehavior,
    yii\behaviors\TimestampBehavior,
    yii\behaviors\BlameableBehavior;
use jlorente\tagable\exceptions\SaveException;
use yii\db\ActiveRecord,
    yii\db\ActiveQuery;
use Yii;

/**
 * This is the model class for table "jl_tgb_tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $color
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class Tag extends ActiveRecord {

    /**
     * Gets the name of the relational table.
     * 
     * @return string
     */
    public static function relationTableName() {
        return 'jl_tgb_tag_model';
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'jl_tgb_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'slug', 'color'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'slug', 'color'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['color', ColorValidator::className()],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('jlorente/tagable', 'ID'),
            'name' => Yii::t('jlorente/tagable', 'Name'),
            'slug' => Yii::t('jlorente/tagable', 'Slug'),
            'color' => Yii::t('jlorente/tagable', 'Color'),
            'created_at' => Yii::t('jlorente/tagable', 'Created At'),
            'created_by' => Yii::t('jlorente/tagable', 'Created By'),
            'updated_at' => Yii::t('jlorente/tagable', 'Updated At'),
            'updated_by' => Yii::t('jlorente/tagable', 'Updated By'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::className(),
                'ensureUnique' => true,
                'immutable' => false,
                'attribute' => 'name'
            ],
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ]);
    }

    /**
     * 
     * @param int $id
     * @return static
     * @throws SaveException
     */
    public static function getOrCreate($id) {
        $tag = static::find()->where(['id' => $id])->one();
        if ($tag === null) {
            $tag = new static([
                'name' => $id,
                'color' => ColorValidator::randColor()
            ]);
            if ($tag->save() === false) {
                throw new SaveException($tag);
            }
        }
        return $tag;
    }

    /**
     * 
     * @return TagQuery
     */
    public static function find() {
        return Yii::createObject(TagQuery::className(), [get_called_class()]);
    }

}

/**
 * 
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class TagQuery extends ActiveQuery {
    
}
