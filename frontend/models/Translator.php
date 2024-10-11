<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "translators".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $weekend_work
 */
class Translator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'weekend_work'], 'required'],
            [['weekend_work'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'weekend_work' => Yii::t('app', 'Weekend Work'),
        ];
    }

    public function switchStatus()
    {
        $this->updateAttributes(['weekend_work' => !$this->weekend_work]);
    }

    public static function getTranslatorListByType(bool $weekend = true): array
    {
        return self::find()->select(['full_name' => 'CONCAT(first_name, " ", last_name)'])
            ->where(['weekend_work' => $weekend])
            ->indexBy('id')->asArray()->column();
    }
}
