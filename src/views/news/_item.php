<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\models\News */

?>
<div class="news-view">

    <div class="row">
        <div class="col-md-8">
            <h3><?= Html::a($model->title, ['news/view', 'id' => $model->id]) ?></h3>
            <sub><?= date('d.m.Y H:i', $model->created_at) ?></sub>
            <p>
                <?= $model->content ?>
            </p>
        </div>
        <div class="col-md-4">
            <?php if ($model->filename): ?>
                <img class="img-responsive" src="<?= $model->getImageOnWeb() ?>" alt="">
            <?php endif ?>
        </div>
    </div>


</div>
