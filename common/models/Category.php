<?php 

namespace common\models;
 
use Yii;
use common\models\H;
use common\models\ProductCategory as PC;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class Category extends \kartik\tree\models\Tree
{
	public static function tableName()
    {
        return 'category';
    }


    public static function getCatsWithProducts()
	{
		$result = null;
		$pc = PC::find()->select(['category_id'])->distinct()->asArray()->all();		
		if ($pc) {
			$distinct = ArrayHelper::map($pc, 'category_id', null);
			$result = self::find()->where(['id'=>array_keys($distinct), 'lvl'=>1])->select(['name', 'id'])->all();
		}

		return $result;
	}  
}