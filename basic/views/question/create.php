<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Create new Question';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
