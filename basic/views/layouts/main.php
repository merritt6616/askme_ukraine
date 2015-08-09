<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Survey;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php


?>


<?php $this->beginBody() ?>
    <div class="container--site">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= Html::a('AskMe', ['site/index'], ['class'=>'navbar-brand']) ?>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right ">
                        <li>
                        <?=
                        !Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1?
                            Html::a('My Surveys', ['/survey/indexown']):''
                        ?>
                        </li>
                        <li>
                        <?=
                        !Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1?
                            Html::a('Create Survey', ['/survey/create']):''
                        ?>
                        </li>
                        <li>

                        <?=
                        Yii::$app->user->isGuest ?
                            Html::a('Register', ['/user/create']):''
                        ?>
                        </li>
                        <li>
                        <?=
                        Yii::$app->user->isGuest ?
                            Html::a('Login', ['/user/login']):
                            Html::a('Logout('.Yii::$app->user->identity->user_username.')', ['/user/logout'], ['data-method'=>'post'])

                        ?>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <?php
        /*
            NavBar::begin([
                'brandLabel' => 'SurveyBot',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    !Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1?
                        ['label' => 'Meine Surveys', 'url' => ['/survey/indexown']]:'',
                    !Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1?
                        ['label' => 'Survey erstellen', 'url' => ['/survey/create']]:'',
                    Yii::$app->user->isGuest ?
                        ['label' => 'Registrieren', 'url' => ['/user/create']]:'',
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->user_username . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        */
        ?>

        <main class="container content--main">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options'=>['class' => 'reset--padding widget--breadcrumbs'],
                'itemTemplate' => '<li class="inlineblock icondivider icondivider--smallspace icondivider--arrow widget--breadcrumbs__listitem">{link}</li>',
                'activeItemTemplate' => '<li class="inlineblock">{link}</li>'
            ]) ?>

            <?= $content ?>

        </main>
    </div>

    <footer class="footer">
        <div class="container ">
            <div class="island--onlyVerticalSpace">
                <span class="pull-left">
                    &copy; Patrick Santy  <?= date('Y') ?>
                </span>
                <span class="pull-right"><?= Yii::powered() ?></span>

            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap/collapse.js" type="text/javascript"></script>
<script src="js/Chart.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>
