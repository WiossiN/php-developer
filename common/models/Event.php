<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['goal', 'cost', 'endpoint', 'status'], 'required'],
            [['cost'], 'integer'],
            [['goal', 'endpoint', 'status'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_CONFIRMED, self::STATUS_REJECTED]],
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
}
