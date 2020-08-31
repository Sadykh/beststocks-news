<?php

namespace app\controllers;

use app\models\NewsSearch;
use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
