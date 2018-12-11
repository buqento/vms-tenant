<?php


namespace app\controllers;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\helpers\Json;

class VisitedController extends Controller
{
    public function actionIndex()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setUrl('http://localhost:8000/visited')
            ->addHeaders(['content-type' => 'application/json'])
            ->send();
        $data = Json::decode($response->content);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $rows = $dataProvider->getModels();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'rows' => $rows
        ]);
    }

    public function actionView($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setUrl('http://localhost:8000/visited/'.$id)
            ->addHeaders(['content-type' => 'application/json'])
            ->send();
        $data = Json::decode($response->content);
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $rows = $provider->getModels();

        return $this->render('view', [
            'rows' => $rows
        ]);
    }

    public function actionApprove($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('PUT')
            ->setUrl('http://localhost:8000/visited/'.$id)
            ->send();
        if ($response->isOk) {
            return $this->redirect(['index']);
        }
    }
}
