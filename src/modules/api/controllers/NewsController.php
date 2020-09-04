<?php

namespace app\modules\api\controllers;

use app\models\News;
use app\models\NewsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return [
            'items' => $dataProvider->getModels(),
            'pagination' => [
                'total_count' => $dataProvider->getPagination()->totalCount,
                'per_page' => $dataProvider->getPagination()->getPageSize(),
                'total_pages' => $dataProvider->getPagination()->getPageCount(),
            ],
        ];
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * @param $id
     * @return News
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = News::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}
