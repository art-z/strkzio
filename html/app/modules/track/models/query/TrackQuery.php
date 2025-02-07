<?php

namespace app\modules\track\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\track\models\Track]].
 *
 * @see \app\modules\track\models\Track
 */
class TrackQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\track\models\Track[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\track\models\Track|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
