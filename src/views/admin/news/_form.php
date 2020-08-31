<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'imageFile')->fileInput() ?>
            <?php if ($model->filename): ?>
                <img src="<?= $model->getImageOnWeb() ?>" alt="" class="img-responsive">
            <?php endif ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
