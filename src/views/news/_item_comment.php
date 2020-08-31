<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model \app\models\Comment */

?>
<div class="comment-view">

    <p><b><?= $model->name ?></b>
    <sup><?= date('d.m.Y H:i', $model->created_at) ?></sup>
    </p>
    <p>
        <?= $model->content ?>
    </p>

</div>
