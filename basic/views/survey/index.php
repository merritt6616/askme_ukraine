<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Session;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="survey-index">
<?php  if ( (!empty($dataProviderActive->getModels()) && !isset($ownSurveys)) || (!Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster && !empty($dataProvider->getModels()) )): ?>

<?php
    if (isset($ownSurveys)) {
        $this->title = 'My Surveys';
        echo '<h1 class="text-center headline--colorless">'.Html::encode($this->title).'</h1>';
    }
    if (isset($isHomePage) ) {

        $this->title = 'Surveys';

        echo Yii::$app->user->isGuest ?
             '<h2 class="text-center headline--colorless">'.Html::encode($this->title).'</h2>':
             '<h1 class="text-center headline--colorless">'.Html::encode($this->title).'</h1>';

    }
    if (!isset($isHomePage))
        $this->params['breadcrumbs'][] = $this->title;
?>
<?php else:?>
        <h1 class="headline--large">There are no active surveys at the moment.</h1>
<?php endif;?>
    <?php
        //Models (Surveys) aus gelieferten dataProvider holen (aus SiteController oder SurveyController)
        foreach ($dataProvider->getModels() as $data) {

            if ($data->survey_activated == 1 || (!Yii::$app->user->isGuest && $data->user->id == Yii::$app->user->identity->id) ){

            $date = date('d.m.Y', $data->survey_timestamp);
            $time = date('H:i', $data->survey_timestamp);

            $endtime_timestamp = $data->survey_timestamp + $data->survey_runtime;
            $endtime_date = date('d.m.Y', $endtime_timestamp);
            $endtime_time = date('H:i', $endtime_timestamp);

           echo '<div class="widget--surveyindex__item row spacer--small--downward">';
           echo '<h3 class="col-md-12 ">'.
                    $data->survey_name.
                '</h3>';
           echo '<div class="col-md-4">';
               echo '<div class="row  spacer--small--downward">';
                   echo '<span class="col-xs-6 col-md-12 block--relative"><strong>Occasion:</strong> '.$data->survey_theme.'</span>'.
                        '<span class="col-xs-6 col-md-12 block--relative glyphicon glyphicon-time iconbefore--smallspace--right">This survey ends <br> on the <strong>'.$endtime_date.'</strong> at <strong>'.$endtime_time.' o\'clock</strong></span>';
               echo '</div>';
           echo '</div>';
           echo '<div class="col-md-8">'.
                   '<div class="row">';
                       echo '<div class="col-xs-6 col-md-7 spacer--small--downward">';
                           echo '<div class="row">';
                               echo '<div class="col-md-6 spacer--small--downward">'.
                                    'Created by '.$data->user->user_username.
                                    '</div>';

                               $session = Yii::$app->session;
                               if ( ($data->survey_activated && $session['survey--'.$data->id] != 1) && !Yii::$app->user->isGuest){
                                    echo '<div class="col-md-6 ">'.
                                        Html::a('Take survey', ['/survey/takesurvey/', 'id' =>$data->id], ['class' => 'btn']).
                                        '</div>'
                                    ;
                               }
                               elseif (Yii::$app->user->isGuest) {
                                   echo '<div class="col-md-6 ">'.
                                       'You must be logged in to take part in a survey.'.
                                       '</div>';
                               }
                               elseif (!$data->survey_activated) {

                                   echo '<div class="col-md-6 ">'.
                                       'This survey is deactivated.'.
                                       '</div>';
                               }
                               else {
                                    echo '<div class="col-md-6 ">'.
                                        'You have already taken part in this survey.'.
                                        '</div>';
                               }
                           echo '</div>';
                       echo '</div>';
                       echo '<div class="col-xs-6 col-md-5 spacer--small--downward">';
                            echo '<div class="row">';

                               if (!Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1 && ($data->user->id == Yii::$app->user->identity->id)) {
                                   echo '<div class="col-md-12">'.
                                        '<div class="row">'.
                                        '<strong class="col-xs-12 glyphicon glyphicon-wrench iconbefore--smallspace--right">Admin Tools</strong>';
                                           if ($data->survey_activated == 1) {
                                               echo '<div class="col-xs-6 ">'.
                                                        'Activated'.
                                                    '</div>';
                                           }
                                           else {
                                               echo '<div class="col-xs-6 ">'.
                                                        'Deactivated'.
                                                    '</div>';
                                           }

                                           echo '<div class="col-xs-6 ">'.
                                                    Html::a('Show details', ['/survey/view/', 'id' =>$data->id], ['class' => 'btn']).
                                                '</div>';

                                        echo '</div>';
                                   echo '</div>';
                               }
                            echo '</div>';
                       echo '</div>';

                   echo '</div>';
           echo  '</div>';
           echo  '</div>';
            //Wenn ein Benutzer eingeloggt ist, Administrator ist und seine ID die gleiche ist wie die, die bei der
            //Umfrage abgelegt wurde (die Umfrage ihm also gehört), gebe das Steuerungselement aus.
            }
            }

    ?>

    <?= !Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster == 1  && isset($ownSurveys) ?
        Html::a('Create new Survey', ['create'], ['class' => 'btn btn--fullwidth spacer--small--upward']):""  ?>


</div>
