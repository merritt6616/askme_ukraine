<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Theme".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Survey[] $surveys
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys()
    {
        return $this->hasMany(Survey::className(), ['theme_id' => 'id']);
    }
}
