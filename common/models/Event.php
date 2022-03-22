<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $goal
 * @property int $cost
 * @property string $endpoint
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Event extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_REJECTED = 'rejected';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goal', 'cost', 'endpoint'], 'required'],
            [['cost', 'endpoint'], 'integer'],
            [['goal', 'status'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_CONFIRMED, self::STATUS_REJECTED]],
            ['endpoint', 'in', 'range' => ArrayHelper::map(Endpoint::find()->select(['id'])->asArray()->all(), 'id', 'id')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goal' => 'Goal',
            'cost' => 'Cost',
            'endpoint' => 'Endpoint',
            'status' => 'Status',
        ];
    }

    /**
     * @return array status
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CONFIRMED => 'Подтверждён',
            self::STATUS_REJECTED => 'Отклонён',
        ];
    }

    /**
     * @return string status
     */
    public function getStatusName()
    {
        return self::getStatusOptions()[$this->status];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndpoints()
    {
        return $this->hasOne(Endpoint::className(), ['id' => 'endpoint']);
    }

    /**
     * @return array
     */
    public function getParamsArray()
    {
        $array = [];
        
        if ($this->endpoints->id_call !== Null && $this->endpoints->id_call !== '') $array[$this->endpoints->id_call] = $this->id;
        if ($this->endpoints->goal_call !== Null && $this->endpoints->goal_call !== '') $array[$this->endpoints->goal_call] = $this->goal;
        if ($this->endpoints->cost_call !== Null && $this->endpoints->cost_call !== '') $array[$this->endpoints->cost_call] = $this->cost;

        return $array;
    }
}
