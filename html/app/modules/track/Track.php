<?php

namespace app\modules\track;

/**
 * track module definition class
 */
class Track extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'track';
    public $controllerNamespace = 'app\modules\track\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->params['status_list'] = [
            'new' =>'New',
            'in_progress' =>'In progress',
            'completed' =>'Completed',
            'failed' =>'Failed',
            'canceled' =>'Canceled',
        ];

        $this->params['multiple_actions'] = [
            'update',
        ];


    }
}
