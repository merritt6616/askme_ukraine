<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">

        <h1 class="headline--large reset--margin spacer--small--downward"><?= Html::encode($this->title) ?></h1>

        <div class="site-login card--content col-sm-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}{input}{error}",
                    'labelOptions' => ['class' => 'control-label'],
                ],
            ]); ?>


                <?= $form->field($model, 'user_username')->textInput(['class'=>'form-control']) ?>
                <?= $form->field($model, 'user_password')->passwordInput(['class'=>'form-control']) ?>


            <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn--fullwidth', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
