<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use common\models\Product;
use common\models\H;
use common\models\ProductInfo as Info;


class ProductController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],            
        ];
    }

    public function actionIndex()
    { 
    	$products = Product::find()
    				->where(['active'=>Product::STATUS_ACTIVE, 'delete'=>Product::STATUS_NOT_DELETED])
    				->all();


    	return $this->render('index', compact('products'));
    }

    public function actionCreate()
    {
    	$product = new Product();
    	$info = new Info();

    	if ($product->load(Yii::$app->request->post())) {
    		$product->files = UploadedFile::getInstances($product, 'files');
    		if ($product->saveProduct()) {
    			return $this->redirect(['update', 'id'=>$product->id]);
    		}
    	}
    	return $this->render('create', compact('product', 'info'));
    }

    public function actionUpdate()
    {
    	$id = (int)Yii::$app->request->get('id');
    	$product = Product::find()->where(['id' => $id])->with(['allImages'])->one();

    	if (!$product) {
    		return $this->redirect(['index']);
    	}

    	$product->setCategoryString();
    	$info = Info::findOne(['product_id' => $id]);

    	if (Yii::$app->request->isAjax) {
    		$this->handleAjax();
    	}

		if ($product->load(Yii::$app->request->post())) {
			$product->files = UploadedFile::getInstances($product, 'files');
    		if ($product->updateProduct()) {
    			return $this->refresh();
    		}
    	}

    	return $this->render('update', compact('product', 'info'));	
    }

    public function handleAjax()
    {
    	
    }

    public function actionDelete()
    {
    	# code...
    }
}