<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use common\models\Product;
use common\models\ProductImage as Image;
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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        
        $this->view->registerMetaTag(['name' => 'pageName','content' => $this->id]);
        $this->view->registerMetaTag(['name' => 'action','content' => $this->action->id]);
        return true;
    }

    public function actionIndex()
    { 
    	$products = Product::find()
    				->where(Product::findCondition('admin'))
                    ->with(['mainImage'])
    				->all();
        H::ddd($products[0]->mainImage);


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
        if (Yii::$app->request->isAjax) {
            return $this->handleAjax();
        }

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

    public function actionDelete()
    {
        # code...
    }

    public function handleAjax()
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = ['msg'=>'Failed', 'status'=>false];

        $action = Yii::$app->request->post('action');
        $pId = (int)Yii::$app->request->get('id');
        switch ($action) {
            case 'change-main-image':
                if(Image::setMainImage((int)$pId, (int)Yii::$app->request->post('pictureId'))){
                    $result = ['msg'=>'Success', 'status'=>true];
                }
            break;
            case 'delete-product-image':
                if(Image::deleteImage((int)$pId, (int)Yii::$app->request->post('pictureId'))){
                    $result = ['msg'=>'Success', 'status'=>true];
                }
            break;
        }

        return $result;
    }

    
}