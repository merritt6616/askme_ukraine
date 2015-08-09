<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
$this->title = 'AskMe';
?>
<div class="site-index">

    <div class="text-center spacer--large--downward">

        <?php  if (Yii::$app->user->isGuest  ) :  ?>
            <h1 class="headline--gigantic">Welcome to AskMe!</h1>
            <p >The first hidden service for rapidly mass capturing opinions.</p>
            <?= Html::a('Login', ['user/login'], ['class' => 'btn']) ?>
        <?php endif;?>

    </div>

    <div class="body-content">
        <?php
        if (!Yii::$app->user->isGuest)
            echo $this->render('/survey/index', ['dataProvider'=>$dataProvider,'dataProviderActive'=>$dataProviderActive , 'isHomePage'=>$isHomePage]);

        ?>
    </div>
</div>
