<?php

namespace app\modules\track\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "track".
 *
 * @property int $id
 * @property string $track_number
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Track extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'track';
    }

    public function fields()
    {
        return [
            'id',
            'track_number',
            'status',
            'created_at',
            'updated_at'
        ];
    }


    public function rules()
    {
        return [
            [['track_number'], 'required'],
            [['track_number'], 'unique'],
            [['track_number'], 'string', 'max' => 255],

            [['created_at', 'updated_at'], 'default', 'value' => time()],

            [['status'], 'required'],
            [['status'], 'string'],
            [['status'], 'in', 'range' => array_keys(\Yii::$app->getModule('track')->params['status_list'])],

            [['created_at', 'updated_at'], 'integer'],

        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class, [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => false,
                'updatedByAttribute' => false

            ]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'track_number' => 'Track Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\track\models\query\TrackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\track\models\query\TrackQuery(get_called_class());
    }


}
