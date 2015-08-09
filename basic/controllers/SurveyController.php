<?php

namespace app\controllers;

use Faker\Provider\cs_CZ\DateTime;
use Yii;
use app\models\Survey;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class SurveyController extends Controller
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
     * Lists all Survey models.
     * @return mixed
     */
    public function actionIndex()
    {
            $dataProvider = new ActiveDataProvider([
                'query' => Survey::find(),
            ]);
            $dataProviderActive = new ActiveDataProvider([
                'query' => Survey::find()->where(['survey_activated' => 1]),
            ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderActive' =>$dataProviderActive

        ]);
    }
    public function actionIndexown()
    {
        if (!Yii::$app->user->isGuest) {

            $dataProvider = new ActiveDataProvider([
                'query' => Survey::find()->where(['user_id'=>Yii::$app->user->identity->id]),
            ]);
        $dataProviderActive = new ActiveDataProvider([
            'query' => Survey::find()->where(['survey_activated' => 1]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderActive' =>$dataProviderActive,
            'ownSurveys' => 1
        ]);
        }
        else return $this->render(['user/notloggedin']);
    }

    /**
     * Displays a single Survey model.
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
     * Creates a new Survey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Survey(['scenario'=>'create']);

        $date = date_create();


        $model->user_id = Yii::$app->user->identity->id;
        $model->survey_timestamp = date_timestamp_get($date);



        if ($model->load(Yii::$app->request->post()) && $model->save() ) {



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
           return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Survey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionToggleactivate ($id){
        $model = $this->findModel($id);

        if ($model->survey_activated == 1) {
            $model->survey_activated = 0;
        }
        elseif ($model->survey_activated ==0) {
            $model->survey_activated = 1;
        }
        if ($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    public function actionTakesurvey ($id){


        $model = Survey::findOne($id);
        return $this->render('takesurvey', ['model' => $model]);


    }

    /**
     * Deletes an existing Survey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['indexown']);
    }

    /**
     * Finds the Survey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Survey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Survey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
