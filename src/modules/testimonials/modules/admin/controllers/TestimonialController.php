<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */


namespace common\modules\testimonials\modules\admin\controllers;

use common\modules\testimonials\modules\admin\forms\TestimonialSearch;
use common\models\BlogPosts;
use common\modules\testimonials\forms\TestimonialEditForm;
use common\modules\testimonials\models\Testimonials;
use common\modules\testimonials\services\TestimonialManageService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TestimonialController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestimonialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $post_id
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $comment = $this->findModel($id);

        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            try {
                Yii::$app->session->setFlash('success', 'Successful update');
                return $this->redirect(['view','id' => $comment->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $comment,
        ]);
    }

    /**
     * @param $post_id
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $comment = $this->findModel($id);
        return $this->render('view', [
            'comment' => $comment,
        ]);
    }

    /**
     * @param $post_id
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionActivate($id)
    {
        $comment = $this->findModel($id);
        try {
            $comment->activate();
            Yii::$app->session->setFlash('success', 'Successful activate');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view','id' => $id]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
   function actionDelete($id)
    {
        $comment = $this->findModel($id);
        try {
            $comment->delete();
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    /**
     * @param $id
     * @return Testimonials|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Testimonials::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
