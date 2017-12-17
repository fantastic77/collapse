<?php

namespace app\modules\order\models;

use app\modules\user\models\UserDB as User;
use Yii;


/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order
 * @property integer $time
 * @property integer $status
 * @property string $notes
 *
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order'], 'required'],
            [['user_id', 'time', 'status'], 'integer'],
            [['order', 'notes'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order' => 'Order',
            'time' => 'Time',
            'status' => 'Status',
            'notes' => 'Notes',

            'userName'        => 'User name',
            'userFullname'    => 'User fullname',
            'userEmail'       => 'User email',
            'userPhone'       => 'User phone',
            'userAddress'     => 'User address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserName()
    {
        return $this->user->username;
    }

    public function getUserFullname()
    {
        return $this->user->fullname;
    }

    public function getUserEmail()
    {
        return $this->user->email;
    }

    public function getUserPhone()
    {
        return $this->user->phone;
    }

    public function getUserAddress()
    {
        return $this->user->address;
    }

    public function getStatusName()
    {
        switch ($this->status) {
            case 0:
                return \Yii::t('order', 'status pending');
                break;
            case 1:
                return \Yii::t('order', 'status in progress');
                break;
            case 2:
                return \Yii::t('order', 'status ready');
                break;
            case 3:
                return \Yii::t('order', 'status closed');
                break;
        }
    }
}
