<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\H;
use common\models\Etsy;
// use common\models\EtsyApi;
use frontend\models\ContactForm;

use yii\authclient\OAuth1;


class EtsyController extends Controller
{
	public function actionIndex()
	{
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
			default:
				die('DD');
				
		}
	}

	public function actionTest()
	{
		phpinfo();
		// $x = new \OAuth();

		// $x = new OAuth1();
		// $etsy = new EtsyApi();

		// $oauthClient = new EtsyApi();
		// $requestToken = $oauthClient->fetchRequestToken(); 
		// H::ddd($x);

		// $etsy->getToken();
	}

	
}