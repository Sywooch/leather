<?php 

namespace common\models;
 
use Yii;
use common\models\H;
use yii\helpers\Html;
use yii\helpers\Url;

class Category extends \kartik\tree\models\Tree
{
	public static function tableName()
    {
        return 'category';
    }  
}