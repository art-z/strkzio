<?php

namespace app\modules\api\controllers;

use app\modules\track\models\Track;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * ApiController implements the CRUD actions for Track model.
 */
class TrackController extends ActiveController
{

    public $modelClass = Track::class;


    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $behaviors;
    }


    public function prepareDataProvider()
    {
        $query = $this->modelClass::find();

        // filter by status
        // tracks?status=TrackModule valid status
        if (\Yii::$app->request->get('status')) {
            $query->andWhere(
                ['status' => \Yii::$app->request->get('status')]
            );
        }
        $query->multiple = true;

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }


    public function actionMultiple()
    {
        $request = \Yii::$app->request;
        $multiple_actions = \Yii::$app->getModule('track')->params['multiple_actions'];
        $action = $request->getBodyParam('action');

        if (!in_array($action, $multiple_actions)) {
            return throw new \yii\web\HttpException(422, 'Action is invalid.');
        }

        if ($action === 'update') {
            return $this->multipleUpdate($request);
        }
    }


    public function multipleUpdate($request)
    {
        $ids = $request->getBodyParam('ids');
        $status = $request->getBodyParam('status');

        if (!$ids) {
            return throw new \yii\web\HttpException(422, 'Ids cannot be blank.');
        }

        $status_list = \Yii::$app->getModule('track')->params['status_list'];
        if (!array_key_exists($status, $status_list)) {
            return throw new \yii\web\HttpException(422, 'Status is invalid.');
        }

        $tracks = $this->modelClass::find()->andWhere(['in', 'id', explode(',', $ids)])->all();

        $updated = [];

        if ($tracks) {
            foreach ($tracks as $track) {
                $track->status = $status;
                if ($track->update()) {
                    $updated[] = $track->id;
                };
            }
        }

        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->andWhere(
                ['in', 'id', $updated]
            )
        ]);
    }

}
