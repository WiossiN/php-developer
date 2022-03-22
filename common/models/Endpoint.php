<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "endpoint".
 *
 * @property int $id
 * @property string $name
 * @property string $endpoint
 * @property string $type
 * @property string $id_call
 * @property string $goal_call
 * @property string $cost_call
 * @property int $created_at
 * @property int $updated_at
 */
class Endpoint extends \yii\db\ActiveRecord
{
    const TYPE_GET = 'GET';
    const TYPE_POST = 'POST';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%endpoint}}';
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
            [['name', 'endpoint', 'type'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'endpoint', 'type', 'id_call', 'goal_call', 'cost_call'], 'string', 'max' => 255],
            ['type', 'in', 'range' => [self::TYPE_GET, self::TYPE_POST]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'endpoint' => 'Endpoint',
            'type' => 'Type',
            'id_call' => 'ID Call',
            'goal_call' => 'Goal Call',
            'cost_call' => 'Cost Call',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return array status
     */
    public static function getTypeOptions()
    {
        return [
            self::TYPE_GET => 'GET',
            self::TYPE_POST => 'POST',
        ];
    }

    /**
     * @return string status
     */
    public function getTypeName()
    {
        return self::getTypeOptions()[$this->type];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['endpoint' => 'id']);
    }
}
