<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Survey */

$this->title = 'Manage Admin Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <span class="text--large glyphicon glyphicon-warning-sign iconbefore--smallspace--right spacer--small--downward block--relative">Please remember your password. A password retrieval system has not yet been implemented.</span>
    <?= $this->render('_form', [
        'isUpdate' => true,
        'model' => $model,
    ]) ?>

</div>
