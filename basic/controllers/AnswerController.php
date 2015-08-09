<?php

namespace app\controllers;

use app\models\Question;
use app\models\Survey;
use Yii;
use app\models\Answer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * AnswerController implements the CRUD actions for Answer model.
 */
class AnswerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Answer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Answer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Answer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Answer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($question_id, $survey_id)
        //$survey_id ist notwendig, um auf die Survey zurückzukommen, für die man die Answer erstellt hat.
    {
        $model = new Answer();

        //Die Question holen, die im survey/view erstellungsformular erstellt wurde.
        $question = Question::find()->where(['id'=>$question_id]);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $model->link('questions', $question->one());
                return $this->redirect(['survey/view/', 'id' => $survey_id]);

            } else {
                return $this->render('create', ['id'=>$question_id,
                    'model' => $model,
                ]);
            }

    }

    /**
     * Updates an existing Answer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    public function actionVote ($vote_id, $survey_id) {
        $model = $this->findModel($vote_id);
        $model->answer_votes += 1;


        // Session setzen. Variable enthält als schlüssel die Survey und als Wert die 1.
        // Im index wird überprüft, ob eine Session variable der Survey 1 entspricht.
        // Wenn ja, wird der teilnehmen Button nicht dargestellt.
        $session = Yii::$app->session;

        if (!isset($session['survey--'.$survey_id])) {
            if (!$session->isActive) {
                $session->open();
            }
            $session->set('survey--'.$survey_id, 1);
        }

        if ($model->save()){
            return 'success!';
        }
    }

    /**
     * Deletes an existing Answer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($survey_id, $vote_id)
    {
        $this->findModel($vote_id)->delete();

        return $this->redirect(['survey/view', 'id'=>$survey_id]);
    }

    /**
     * Finds the Answer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Answer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
