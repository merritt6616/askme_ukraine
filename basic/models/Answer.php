<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Answer".
 *
 * @property integer $id
 * @property string $answer_name
 * @property integer $question_id
 * @property integer $answer_votes
 *
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['answer_name', 'required', 'message'=>'This field may not be empty.'],
            [['answer_name'], 'string', 'max' => 100, 'message'=>'Your entry is too long. Please try again.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer_name' => 'Text',
            'answer_votes' => 'Votes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Answer::className(), ['id' => 'question_id'])->viaTable('Question_Answer', ['answer_id'=>'id']);
    }
}
