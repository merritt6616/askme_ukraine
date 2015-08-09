<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Answer */

$this->title = 'Create new Answer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
