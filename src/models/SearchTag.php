<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\models;

use jlorente\tagable\db\Tag;
use yii\data\ActiveDataProvider;
use yii\base\Model;

/**
 * Model used to search tag objects.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class SearchTag extends Tag {

    /**
     *
     * @var string
     */
    public $type;
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'slug', 'color'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Tag::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'slug', $this->slug]);
        $query->andFilterWhere(['like', 'color', $this->color]);
        
        if (!empty($this->type)) {
            $query->filterType($this->type);
        }
        return $dataProvider;
    }

}
