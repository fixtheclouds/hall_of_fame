<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Event;
use yii\db\ActiveQuery;

/**
 * EventSearch represents the model behind the search form about `common\models\Event`.
 */
class EventSearch extends Event
{

    /**
     * Search keyword
     * @var string
     */
    public $keyword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subtype_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['type', 'date', 'city', 'content', 'place', 'person_name', 'photo', 'status', 'date_from', 'date_to', 'keyword'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Event::find();

        $query = $this->addFilterParams($query, $params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        $dataProvider->setSort(['defaultOrder' => [
            'created_at' => 'DESC'
        ]]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    /**
     * Process filter parameters
     * @param ActiveQuery $query
     * @param array $params
     * @return ActiveQuery
     */
    public function addFilterParams($query, $params) {
        $this->load($params);

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'subtype_id' => $this->subtype_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'event.type', $this->type])
            ->andFilterWhere(['like', 'event.city', $this->city])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'event.photo', $this->photo])
            ->andFilterWhere(['like', 'status', $this->status]);

        if ($this->keyword) {
            $query->innerJoin('subtype', 'subtype.id = event.subtype_id')
                ->leftJoin('profile', 'profile.user_id = event.user_id')
                ->andWhere([
                    'or',
                    ['like', 'place', $this->keyword],
                    ['like', 'person_name', $this->keyword],
                    ['like', 'subtype.name', $this->keyword],
                    ['like', 'profile.name', $this->keyword],
                ]);
        }

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), ['keyword' => 'Ключевое слово']);
    }
}
