<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->survey_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-index">

    <h1><?= Html::encode($model->survey_name) ?></h1>





    <?php



        foreach ($model->questions as $question ) {
            echo '<div class="widget--survey__question widget--survey__question--'.$question->id.'">';
            echo '<h2 class="spacer--small--downward">'.$question->question_name.'</h2>';

            foreach ($question->answers as $answer) {
                $answer_name__trimtext = str_replace(" ","", $answer->answer_name);
                echo '<div class="widget--survey__answer">';

                    echo Html::a($answer->answer_name, '#',["class"=>"widget--survey__answer__link btn btn--fullwidth spacer--small--downward ", "onclick"=>"
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=answer/vote&vote_id=".$answer->id."&survey_id=".$model->id."',
                            success: function (response) {
                                $('.widget--survey__question--".$question->id."').fadeOut();

                            }
                        });
                    "
                    ] );
                echo '</div>';
            }

            echo '</div>';
        }
        echo Html::a('Finish Survey', ['site/index'],["class"=>"widget--survey__endsurvey btn"]);


    ?>

</div>
