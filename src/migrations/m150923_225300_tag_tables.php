<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
use yii\db\Schema;
use yii\db\Migration;
use jlorente\tagable\db\Tag;
use yii\helpers\Inflector;

/**
 * Tag tables creation.
 * 
 * To apply this migration run:
 * ```bash
 * $ ./yii migrate --migrationPath=@vendor/jlorente/yii2-tagable-models/src/migrations
 * ```
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class m150923_225300_tag_tables extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable(Tag::tableName(), [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'color' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'created_by' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER
        ]);
        $this->createTable(Tag::relationTableName(), [
            'model_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'association_type' => Schema::TYPE_STRING . ' NOT NULL',
            'tag_id' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
        $this->createIndex('UNIQUE_Slug', Tag::tableName(), 'slug', true);
        $this->addForeignKey($this->getForeignKeyRelationTag(), Tag::relationTableName(), 'tag_id', Tag::tableName(), 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('UNIQUE_ModelId_AssociationType_TagId', Tag::relationTableName(), ['model_id', 'association_type', 'tag_id'], true);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey($this->getForeignKeyRelationTag(), Tag::relationTableName());
        $this->dropTable(Tag::relationTableName());
        $this->dropTable(Tag::tableName());
    }

    /**
     * Returns the foreign key name of the tag-model relation for tag_id. You can 
     * override this method in order to provide a custom foreign key name.
     * 
     * @return string
     */
    protected function getForeignKeyRelationTag() {
        return 'FK_' . Inflector::camelize(Tag::relationTableName()) . '_TagId';
    }

}
