<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\EtsyFeedbacks;
use common\models\H;
use frontend\models\ContactForm;
use frontend\models\Sitemap;


class ShopController extends Controller
{
	public function actionIndex()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage'])->limit(6)->all();

		// 
		$etsy = new EtsyFeedbacks();
		$feedbacks = $etsy->getFeedBacks();
		// H::ddd($feedbacks);
		// 
		
		return $this->render('index', compact('products', 'feedbacks'));
	}

	public function actionCatalog()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage', 'cats'])->all();

		$categories = Category::getCatsWithProducts();
		
		return $this->render('catalog', compact('products', 'categories'));
	}

	public function actionProduct()
	{
		$model = new ContactForm();
		$product = Product::find()
						->where(Product::findCondition('front'))
						->andWhere(['id'=>(int)Yii::$app->request->get('id')])
						->with(['allImages', 'info'])
						->one();
		
        if ($model->load(Yii::$app->request->post())) {
        	$result = false;
        	if ($model->validate() && $model->sendEmail(Yii::$app->params['adminEmail'])) {
        		$result = true;
        	}
        	if ($result) {
        	   Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
        	} else {
        		Yii::$app->session->setFlash('error', 'There was an error sending your message.');
        	}
        	return $this->refresh();            
        }
		
		return $this->render('product', compact('product', 'model'));
	}

	public function actionContact()
	{
		$model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
        	$result = false;
        	if ($model->validate() && $model->sendEmail(Yii::$app->params['adminEmail'])) {
        		$result = true;
        	}
        	if ($result) {
        	   Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
        	} else {
        		Yii::$app->session->setFlash('error', 'There was an error sending your message.');
        	}
        	return $this->refresh();            
        }

		return $this->render('contact', compact('model'));
	}

	public function actionSitemap()
	{
		$model = new Sitemap();
		$sitemap = $model->generateSitemap();
		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
	    Yii::$app->response->headers->add('Content-Type', 'text/xml');

	    return $this->renderPartial('sitemap', compact('sitemap'));
	}

	
}