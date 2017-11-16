<?php

namespace common\models;

use Yii;

class EtsyProducts extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'etsy_products';
    }

    
    public function rules()
    {
        return [
            [['etsy_product_id', 'etsy_product_object'], 'required'],
            [['etsy_product_id', 'is_exported', 'result_id'], 'integer'],
            [['etsy_product_object', 'images'], 'string'],
        ];
    }
}
