<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;


class ShopController extends Controller
{
	public function actionIndex()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage'])->limit(6)->all();
		
		return $this->render('index', compact('products'));
	}

	public function actionCatalog()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage', 'cats'])->all();

		$categories = Category::getCatsWithProducts();
		
		return $this->render('catalog', compact('products', 'categories'));
	}

	public function actionProduct()
	{
		$product = Product::find()
						->where(Product::findCondition('front'))
						->andWhere(['id'=>(int)Yii::$app->request->get('id')])
						->with(['allImages', 'info'])
						->one();		
		
		return $this->render('product', compact('product'));
	}

	public function actionContact()
	{		
		return $this->render('contact');
	}
}