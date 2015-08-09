<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\Survey */

$this->title = $model->survey_name;
$this->params['breadcrumbs'][] = ['label' => 'My Surveys', 'url' => ['indexown']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-view">
<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->user_isMaster): ?>

    <div class="spacer--small--downward">
        <h1 class="inlineblock--middleAlign reset--margin spacer--small--right spacer--smaller--downward"><?= Html::encode($model->survey_name) ?></h1>
        <div class="inlineblock--middleAlign spacer--smaller--downward nav--inline">
        <?php
                echo Html::a($model->survey_activated == 1 ? 'Deactivate' : 'Activate', ['toggleactivate', 'id' => $model->id], ['class' => 'btn nav--inline__link']);
                echo Html::a('', ['update', 'id' => $model->id], ['class' => 'btn glyphicon glyphicon-pencil nav--inline__link ']);
                echo Html::a('', ['delete', 'id' => $model->id], [
                            'class' => 'btn glyphicon glyphicon-remove nav--inline__link ',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this Survey? This cannot be undone.',
                                'method' => 'post',
                            ],
                        ]);
        ?>
        </div>
    </div>





    <h2>Questions</h2>

    <?php
        if (!empty($model->questions)){
            foreach ($model->questions as $frage) {

                echo '<div class="row  surveyview__question spacer--small--downward">';
                echo '<div class="col-md-5">';
                    echo '<div class="row spacer--small--downward">';
                        echo '<div class="col-xs-8">'.$frage->question_name.'</div>';

                        if (!$model->survey_activated)
                            echo '<div class="col-xs-4">'.Html::a('', ['question/delete', 'survey_id'=>$model->id, 'question_id'=>$frage->id], ['class'=>'btn btn--circle glyphicon glyphicon-remove','data'=>['method'=>'post']]).'</div>';

                    echo '</div>';
                echo '</div>';
                echo '<div class="col-md-7">';
                    echo '<div class="row">';
                        echo '<div class="col-xs-6">';

                            if (!empty($frage->answers)) {

                                $votes_total = 0;
                                $votes_individual = array();
                                $iterator = 0;

                                foreach ($frage->answers as $answer) {
                                    $votes_individual[$iterator] = $answer;
                                    $iterator++;
                                    $votes_total += $answer->answer_votes;


                                }
                                    foreach ($votes_individual as $vote){

                                        echo '<div class="row spacer--small--downward surveyview__answer">'.
                                            '<div class="col-xs-6 surveyview__answer__name">'.
                                             $vote->answer_name.
                                            '</div>';

                                        if (!$model->survey_activated)
                                            echo '<div class="col-xs-6">'.
                                            Html::a('', ['answer/delete', 'survey_id'=>$model->id, 'vote_id'=>$vote->id], ['class'=>'btn btn--circle float--right glyphicon glyphicon-remove ', 'data'=>['method'=>'post']]).
                                            '</div>';

                                        if ($votes_total != 0) {
                                            echo '<div class="col-xs-4 surveyview__answer__votes">'.
                                                '<span class="surveyview__answer__votes--percent">'.sprintf('%02d', (($vote->answer_votes/$votes_total)*100)).'% </span>'.
                                                '<span class="surveyview__answer__votes--absolute">'.$vote->answer_votes.' </span>'.

                                            '</div>'.
                                            '</div>'
                                            ;
                                        }
                                        else {
                                            echo '</div>';
                                        }

                                }
                            }
                      if (!$model->survey_activated)
                        echo Html::a('Create Answer', ['/answer/create/', 'question_id' =>$frage->id, 'survey_id'=>$model->id], ['class' => 'btn btn--fullwidth spacer--large--downward']);

                        echo '</div>';
                        echo '<div class="col-xs-6 surveyview__chart">';

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '</div>';

            }
        }
    ?>

    </div>
    <?php
    if (!$model->survey_activated)
        echo Html::a('Create Question', ['/question/create/', 'id' =>$model->id], ['class' => 'btn btn--responsive--block']);
    ?>


<?php endif;?>

</div>
