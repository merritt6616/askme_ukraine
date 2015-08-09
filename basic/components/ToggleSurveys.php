<?php
    namespace app\components;
    use app\models\Survey;
    use yii\data\ActiveDataProvider;

    class ToggleSurveys extends \yii\base\Component {
        public function init() {
            date_default_timezone_set('Europe/Berlin');

            $dataProvider = new ActiveDataProvider([
                'query' => Survey::find(),
            ]);
            $surveys = $dataProvider->getModels();
            foreach ($surveys as $data) {
                $endtime = $data->survey_timestamp+$data->survey_runtime;
                if ($endtime <= time()) {
                    $data->survey_activated = 0;
                    $data->save();
                }

            }

        parent::init();
        }
    }