<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property integer $send_from
 * @property integer $send_to
 * @property double $sum
 * @property integer $created_at
 *
 * @property User $sendFrom
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'transactions';
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at=time();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->sendFrom->balance=$this->sendFrom->balance-$this->sum;
        $this->sendFrom->save();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_from', 'send_to'], 'integer'],
            ['sum', 'required'],
            [['sum'],'number', 'numberPattern' => '/^-?(\d*[1-9]\d*(\.\d+)?|0*\.\d*[1-9]\d*)$/'],
            [['send_from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['send_from' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'send_from' => 'Send From',
            'send_to' => 'Send To',
            'sum' => 'Sum',
            'crated_at' => 'Created At'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSendFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'send_from']);
    }

    public function trannsfer(){
        $send_to=User::findOne($this->send_to);
        $send_to->balance=$send_to->balance+$this->sum;
        $send_to->save(false);

        return true;
    }
}
