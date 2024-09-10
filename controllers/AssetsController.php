<?php

namespace app\controllers;


use app\models\Asset;
use app\rbac\Rbac;
use app\service\Asset\AssetsServiceInterface;
use app\service\assets\AbstractAssetService;
use app\service\AssetsService;
use Yii;
use app\models\Forms\Assets\{CreateAssetsForm,
    CreateEnumerableAssetForm,
    CreatePhysicalAssetForm,
    SelectAssetTypeFrom,
    UpdateEnumerableAssetForm};
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class AssetsController extends \yii\web\Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $assetTypeModel = new SelectAssetTypeFrom();
        $model = null;
        $assetService = null;

        if ($assetTypeModel->load(Yii::$app->request->get()) && $assetTypeModel->validate()) {
            $assetService = new AssetsService($assetTypeModel->type);

            /** @var CreateEnumerableAssetForm|CreatePhysicalAssetForm $model */
            $model = new ($assetService->getCreateForm());

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $asset = $model->save();

                Yii::$app->session->setFlash('success', 'Актив успешно добавлен.');
                return $this->redirect(['/assets/index']);
            }
        }

        return $this->render('create', [
            'assetTypeModel' => $assetTypeModel,
            'model' => $model,
            'assetService' => $assetService,
        ]);
    }

    public function actionDelete(int $id)
    {
        $asset = $this->findAsset($id);
        $assetService = $this->getAssetService($asset->type);

        /** @var AssetsServiceInterface $assetServiceItem */
        $assetServiceItem = new ($assetService->getAssetService());

        $assetServiceItem->delete($asset);

        Yii::$app->session->setFlash('success', 'Актив успешно удален.');
        return $this->redirect(['/assets/index']);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Asset::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $asset = $this->findAsset($id);
        $assetService = $this->getAssetService($asset);

        $form_name = $assetService->getUpdateForm();

        /** @var UpdateEnumerableAssetForm|UpdatePhysicalAssetForm $model */
        $model = new $form_name($asset);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            Yii::$app->session->setFlash('success', 'Актив успешно изменен.');
            return $this->redirect(['/assets/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'assetService' => $assetService,
        ]);
    }

    protected function findAsset(int $id): Asset
    {
        if (($asset = Asset::find()->where(['id' => $id])->one()) !== null) {
            return $asset;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }

    public function getAssetService(Asset $asset): AssetsService
    {
        return new AssetsService($asset->type);
    }

}
