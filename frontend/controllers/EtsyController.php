<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\H;
use common\models\Etsy;
use frontend\models\ContactForm;


class EtsyController extends Controller
{
	public function actionIndex()
	{
		phpinfo();
		die();
		$action = Yii::$app->request->get('action');
		$etsy = new Etsy();
		switch ($action) {
			case 'set-products':
				$etsy->saveEtsyProducts();
				break;
			case 'set-images':
				$etsy->saveProductImage();
				break;
			case 'export-products':
				$etsy->exportProducts();
				break;
			case 'save-raw-images':
				$etsy->saveRawImages();
				break;
			case 'set-images-to-products':
				$etsy->setUpImagesFromEtsy();
				break;
		}
	}

	
}