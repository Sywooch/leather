<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;


class ShopController extends Controller
{
	public function actionIndex()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage'])->limit(6)->all();
		
		return $this->render('index', compact('products'));
	}
}