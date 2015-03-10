<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'role', 'status'], 'integer'],
            [['createDate', 'updateDate', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'phone', 'city', 'name', 'avatar', 'banner_top', 'params', 'position', 'hobby', 'description'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 100 // in case you want a default pagesize
            ],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'password_hash', $this->password_hash])
                ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'phone', $this->phone])
                ->andFilterWhere(['like', 'city', $this->city])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'avatar', $this->avatar])
                ->andFilterWhere(['like', 'banner_top', $this->banner_top])
                ->andFilterWhere(['like', 'params', $this->params])
                ->andFilterWhere(['like', 'position', $this->position])
                ->andFilterWhere(['like', 'hobby', $this->hobby])
                ->andFilterWhere(['like', 'updateDate', $this->updateDate])
                ->andFilterWhere(['like', 'createDate', $this->createDate])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
