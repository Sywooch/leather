<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class CategoryController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [                    
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],            
        ];
    }

    public function actionIndex()
    {
    	return $this->render('index');
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
}