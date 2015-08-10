<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Survey".
 *
 * @property integer $id
 * @property string $survey_name
 * @property string $survey_theme
 * @property integer $survey_runtime
 * @property integer $survey_timestamp
 * @property integer $survey_activated
 * @property integer $user_id
 *
 * @property User $user
 * @property SurveyQuestion[] $surveyQuestions
 */
class Survey extends \yii\db\ActiveRecord
{




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Survey';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['survey_theme', 'survey_runtime', 'survey_name', 'survey_activated'], 'required', 'message'=>'This field may not be empty.', 'on'=>['create', 'update']],
            ['survey_activated', 'integer', 'on'=>['create', 'update']],
            [['survey_name', 'survey_theme'], 'string', 'max' => 45, 'message'=>'Your entry is too long. Please try again.', 'on'=>['create', 'update']],
            ['survey_runtime', 'match', 'pattern' => '/([0-9][0-9])(:[0-5][0-9]){2}/', 'message'=>'Please enter the runtime according to the format HH:MM:SS.', 'on'=>['create', 'update']]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['survey_theme', 'survey_runtime', 'survey_name', 'survey_activated']; //Scenario Values Only Accepted
        $scenarios['update'] = ['survey_theme', 'survey_runtime', 'survey_name', 'survey_activated']; //Scenario Values Only Accepted
        return $scenarios;
    }

/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'survey_name' => 'Title',
            'survey_theme' => 'Occasion',
            'survey_runtime' => 'Runtime',
            'survey_timestamp' => 'Time of creation',
            'survey_activated' => 'Activated',
            'user_id' => 'User  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['Id' => 'user_id']);
    }

    public function getSurvey()
    {
        return $this->hasOne(Theme::className(), ['id' => 'theme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['id' => 'question_id'])->viaTable('Survey_Question', ['survey_id'=>'id']);
    }


    public function afterValidate (){

            if (isset(Yii::$app->request->post()['Survey']['survey_runtime'])) {

                $laufzeit = Yii::$app->request->post()['Survey']['survey_runtime'];

                list($hours, $minutes, $seconds) =  sscanf($laufzeit, "%d:%d:%d");


                $laufzeit_sec = $hours*3600+$minutes*60+$seconds;

                $this->survey_runtime = $laufzeit_sec;
            }


            if ($this->survey_activated == 1) {
                $date = date_create();
                $this->survey_timestamp = date_timestamp_get($date);
            }
    }
}
