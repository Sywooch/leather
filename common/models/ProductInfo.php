<?php

namespace common\models;

use Yii;

class ProductInfo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'product_info';
    }


    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['tags', 'materials', 'seo_keywords'], 'string', 'max' => 255],
            [['description', 'seo_description'], 'string'],
        ];
    }
}
