<?php

namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\PostSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\AccessControl;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
          /*  'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create','index','view','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
                'access' => [
                   // 'class' => 'common\components\AccessControl'
                    'class'=> AccessControl::class //เพราะว่าในaacess Con ทำการอ้างไปที่ path นั้นแล้ว
        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        //if(Yii::$app->user->can('post-index')) {

        $searchModel = new PostSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

       // } else echo"<center><p> ไม่สามารถดำเนินการได้ #128517;</p><center>";
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      //  if(Yii::$app->user->can('post-view')) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        // } //else echo"<center><h2><p> ไม่สามารถดำเนินการได้ &#128517;</p></h2><center>";
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      //  if(Yii::$app->user->can('post-create')) {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        // } //else echo"<center><h2><p> ไม่สามารถดำเนินการได้ &#128517;</p></h2><center>";
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       // if(Yii::$app->user->can('post-update')) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        // } //else echo"<center><h2><p> ไม่สามารถดำเนินการได้ &#128517;</p></h2><center>";
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      //  if(Yii::$app->user->can('post-delete')) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        // } //else echo"<center><h2><p> ไม่สามารถดำเนินการได้ &#128517;</p></h2><center>";
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
