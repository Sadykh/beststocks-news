<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <sub><?= date('d.m.Y H:i', $model->created_at) ?></sub>
    <p>
        <?= $model->content ?>
    </p>

</div>
