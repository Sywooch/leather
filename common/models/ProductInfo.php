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
            [['description', 'tags', 'materials', 'seo_keywords', 'seo_description'], 'string', 'max' => 255],
        ];
    }
}
