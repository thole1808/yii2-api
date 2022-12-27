<?php

namespace app\modules\admin\controllers;

// use yii\web\Controller;
use yii\rest\Controller;
use Yii;
use yii\base\ErrorException;
/**
 * Default controller for the `admin` module
 */
class UserController extends Controller
{   

    public function behaviors() {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }

    public function actionIndex() {
        try {
            $getNoVa= Yii::$app->request->get('no_va');
            $getVa = (new \yii\db\Query())
            ->select(['*'])
            ->from('tr_kontrak_va')
            ->where(['no_va'=> $getNoVa])
            ->all();

            for($idx = 0; $idx < count($getVa); $idx++){
                $obj = (Array)$getVa[$idx];
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return 
                [   
                    'metadata' => [
                        'response_code' => '200',
                        'message' => 'Sukses'
                    ],
                    'data' => $obj,
                ]
            ;
            
        } catch (ErrorException $e) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return 
            [   
                'metadata' => [
                    'response_code' => '400',
                    'message' => 'Bad Request'
                ],
                'data' => null,
            ];
        } 

    }

}
