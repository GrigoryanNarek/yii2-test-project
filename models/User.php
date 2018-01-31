<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            ['nik', 'required'],
            ['nik', 'required'],
            ['nik', 'string', 'length' => [1, 15]],
            ['nik', 'unique'],
            ['balance', 'required'],
            [['balance'],'number', 'numberPattern' => '/^-?(\d*[1-9]\d*(\.\d+)?|0*\.\d*[1-9]\d*)$/'],
            [['nik','balance'], 'safe'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            return true;
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user=parent::find()->where(['id' => $id])->one();
        if($user){
            return $user;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user=parent::find()->where(['accessToken' => $token])->one();
        if($user){
            return $user;
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $nik
     * @return static|null
     */
    public static function findByNik($nik)
    {
        $user = parent::find()->where(['nik' => $nik])->one();

        if($user){
            return $user;
        }else{
            $user=(new self);
            $user->setAttribute('nik',$nik);
            $user->save();
            return $user;
        }
    }

    /**
     * Update user balance
     *
     * @param integer $id
     * @param integer $balance
     * @return static|null
     */
    public static function updateBalance($id, $balance) {
        $user = parent::findOne($id);
        if(!$user) {
            return $user;
        }
        $user->balance += $balance;
        $user->update();

        return $user;
    }

    /**
     * Update user balance
     *
     * @param integer $id
     * @param integer $balance
     * @return static|null
     */
    public static function updatCurentBalance($balance) {
        $id = Yii::$app->user->getId();
        $user = parent::findOne($id);
        if(!$user) {
            return $user;
        }
        $user->balance -= $balance;
        $user->update();
        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
