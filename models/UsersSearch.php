<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $nik
 * @property integer $balance
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Transactions[] $transactions
 */
class UsersSearch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance'], 'integer'],
            [['nik'], 'string', 'max' => 12],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['nik'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nik' => 'Nik',
            'balance' => 'Balance',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['send_from' => 'id']);
    }

    public static function search()
    {
        $query = parent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions

        return $dataProvider;
    }
}
