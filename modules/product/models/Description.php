<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "description".
 *
 * @property integer $id
 * @property integer $productId
 * @property string $eng_Name
 * @property string $ukr_Name
 * @property string $rus_Name
 * @property string $eng_Description
 * @property string $ukr_Description
 * @property string $rus_Description
 *
 * @property Products $product
 */
class Description extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId'], 'required'],
            [['productId'], 'integer'],
            [['eng_Description', 'ukr_Description', 'rus_Description'], 'string'],
            [['eng_Name', 'ukr_Name', 'rus_Name'], 'string', 'max' => 64],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['productId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productId' => 'Product ID',
            'eng_Name' => 'Eng  Name',
            'ukr_Name' => 'Ukr  Name',
            'rus_Name' => 'Rus  Name',
            'eng_Description' => 'Eng  Description',
            'ukr_Description' => 'Ukr  Description',
            'rus_Description' => 'Rus  Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'productId']);
    }
}
