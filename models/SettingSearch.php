<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Setting;

/**
 * SettingSearch represents the model behind the search form about `app\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userCreate', 'userUpdate'], 'integer'],
            [['emailAdmin', 'emailSupport', 'emailOrder', 'sendgridUsername', 'sendgridPassword', 'whatsappNumber', 'whatsappPassword', 'facebook', 'instagram', 'google', 'twitter', 'privacyPolicy', 'terms', 'legalNotice', 'createDate', 'updateDate'], 'safe'],
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
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userCreate' => $this->userCreate,
            'userUpdate' => $this->userUpdate,
            'createDate' => $this->createDate,
            'updateDate' => $this->updateDate,
        ]);

        $query->andFilterWhere(['like', 'emailAdmin', $this->emailAdmin])
            ->andFilterWhere(['like', 'emailSupport', $this->emailSupport])
            ->andFilterWhere(['like', 'emailOrder', $this->emailOrder])
            ->andFilterWhere(['like', 'sendgridUsername', $this->sendgridUsername])
            ->andFilterWhere(['like', 'sendgridPassword', $this->sendgridPassword])
            ->andFilterWhere(['like', 'whatsappNumber', $this->whatsappNumber])
            ->andFilterWhere(['like', 'whatsappPassword', $this->whatsappPassword])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'google', $this->google])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'privacyPolicy', $this->privacyPolicy])
            ->andFilterWhere(['like', 'terms', $this->terms])
            ->andFilterWhere(['like', 'legalNotice', $this->legalNotice]);

        return $dataProvider;
    }
}
