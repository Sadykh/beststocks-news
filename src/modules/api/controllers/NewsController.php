<?php

namespace app\modules\api\controllers;

use app\models\CommentForm;
use app\models\CommentSearch;
use app\models\ContactForm;
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
        $model = $this->findModel($id);
        $commentSearchModel = new CommentSearch();
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams, $model->id);

        return [
            'news' => $model,
            'comments' => [
                'items' => $commentDataProvider->getModels(),
                'pagination' => [
                    'total_count' => $commentDataProvider->pagination->totalCount,
                    'per_page' => $commentDataProvider->pagination->getPageSize(),
                    'total_pages' => $commentDataProvider->pagination->getPageCount(),
                ],
            ],
        ];
    }

    public function actionCommentAdd()
    {
        $commentForm = new CommentForm();
        if ($commentForm->load(Yii::$app->request->post()) && $commentForm->save()) {
            Yii::$app->session->setFlash('success', 'Комментарий успешно добавлен');

            return $this->refresh();
        }

        return [
            'errors' => $commentForm->getErrors(),
        ];
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
