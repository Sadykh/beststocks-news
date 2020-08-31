<?php

use yii\captcha\Captcha;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $commentForm \app\models\CommentForm */
/* @var $commentDataProvider ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <hr>
    <h3>Список комментариев</h3>
    <?= ListView::widget([
        'dataProvider' => $commentDataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item_comment',
    ]) ?>
    <hr>
    <h3>Оставить комментарий</h3>
    <?php $form = ActiveForm::begin(['id' => 'comment-form']); ?>

    <?= $form->field($commentForm, 'name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($commentForm, 'email') ?>

    <?= $form->field($commentForm, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($commentForm, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
