<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Question".
 *
 * @property integer $id
 * @property string $question_name
 *
 * @property Answer[] $answers
 * @property SurveyQuestion[] $surveyQuestions
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['question_name', 'required', 'message'=>'This field may not be empty.'],
            [['question_name'], 'string', 'max' => 100, 'message'=>'Your entry is too long. Please try again.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_name' => 'Question',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['id' => 'answer_id'])->viaTable('Question_Answer', ['question_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys()
    {
        return $this->hasMany(Survey::className(), ['id' => 'survey_id'])->viaTable('Survey_Question', ['question_id'=>'id']);
    }
}
