<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Survey */

$this->title = 'Update Survey: ' . ' ' . $model->survey_name;
$this->params['breadcrumbs'][] = ['label' => 'Meine Umfragen', 'url' => ['indexown']];
$this->params['breadcrumbs'][] = ['label' => $model->survey_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="survey-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'isUpdate' => true,
        'model' => $model,
    ]) ?>

</div>
