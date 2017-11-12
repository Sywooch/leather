<?php

namespace common\models;

use Yii;

class ProductCategory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product_category';
    }

    public function rules()
    {
        return [
            [['product_id', 'category_id'], 'required'],
            [['product_id', 'category_id'], 'integer'],
        ];
    }
}
