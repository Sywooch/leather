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
		// 
		Yii::$app->view->registerMetaTag([
	        'name' => 'og:image',
	        'content' => 'http://diano.store/images/common/1.jpg',
	    ]);
		
		return $this->render('index', compact('products', 'feedbacks'));
	}

	public function actionCatalog()
	{
		$products = Product::find()->where(Product::findCondition('front'))->with(['mainImage', 'cats'])->all();

		$categories = Category::getCatsWithProducts();

		Yii::$app->view->registerMetaTag([
	        'name' => 'og:image',
	        'content' => 'http://diano.store/images/common/1.jpg',
	    ]);
		
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

		Yii::$app->view->registerMetaTag([
	        'name' => 'og:image',
	        'content' => $product->showImage(['name'=>$product->mainImage->name, 'type'=>'md']),
	    ]);
		
        if ($model->load(Yii::$app->request->post())) {
        	$model->body .= "\r\n". \yii\helpers\Url::current([], true);
        	$result = false;
        	if ($model->validate() && $model->sendEmail()) {
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

		Yii::$app->view->registerMetaTag([
	        'name' => 'og:image',
	        'content' => 'http://diano.store/images/common/1.jpg',
	    ]);


        if ($model->load(Yii::$app->request->post())) {
        	$result = false;
        	if ($model->validate() && $model->sendEmail()) {
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