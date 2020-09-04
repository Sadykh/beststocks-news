<?php

namespace app\modules\api\controllers;

use app\models\CommentForm;
use app\models\CommentSearch;
use Yii;
use yii\web\Controller;

class CommentsController extends Controller
{
    public function actionIndex($id)
    {
        $commentSearchModel = new CommentSearch();
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams, $id);

        return [
            'items' => $commentDataProvider->getModels(),
            'pagination' => [
                'total_count' => $commentDataProvider->pagination->totalCount,
                'per_page' => $commentDataProvider->pagination->getPageSize(),
                'total_pages' => $commentDataProvider->pagination->getPageCount(),
            ],
        ];
    }

    public function actionAdd()
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
}
