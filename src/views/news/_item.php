<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\models\News */

?>
<div class="news-view">

    <h3><?=Html::a($model->title, ['news/view', 'id' => $model->id])?></h3>
    <sub><?= date('d.m.Y H:i', $model->created_at) ?></sub>
    <p>
        <?= $model->content ?>
    </p>

</div>
