<?php

namespace app\controllers;

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

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        $commentSearchModel = new CommentSearch();
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams, $model->id);

        $commentForm = new CommentForm();
        if ($commentForm->load(Yii::$app->request->post()) && $commentForm->save($model)) {
            Yii::$app->session->setFlash('success', 'Комментарий успешно добавлен');

            return $this->refresh();
        }

        return $this->render('view', [
            'commentForm' => $commentForm,
            'model' => $model,
            'commentDataProvider' => $commentDataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
