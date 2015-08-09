<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Survey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-form">

    <?php
        $hours = sprintf('%02d', floor($model->survey_runtime / 3600) );
        $minutes = sprintf('%02d', floor( ($model->survey_runtime % 3600) / 60) );
        $seconds = sprintf ('%02d', floor( (($model->survey_runtime % 3600) % 60) ) );
        $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'survey_theme')->textInput(['maxlength' => true]) ?>

    <?= isset($isUpdate) && $isUpdate ? $form->field($model, 'survey_runtime')->textInput(['value' => $hours.':'.$minutes.':'.$seconds]) : $form->field($model, 'survey_runtime')->textInput()?>

    <?= $form->field($model, 'survey_activated')->checkbox(['uncheck'=>0]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Send', ['class' => $model->isNewRecord ? 'btn btn--responsive--block' : 'btn btn--responsive--block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
