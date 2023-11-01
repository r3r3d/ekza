<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_job
 * @property string $fio
 * @property string $family
 * @property int $age
 * @property int $childs
 *
 * @property Job $job
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_job', 'fio', 'family', 'age', 'childs'], 'required'],
            [['id_user', 'id_job', 'age', 'childs'], 'integer'],
            [['fio', 'family'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_job'], 'exist', 'skipOnError' => true, 'targetClass' => Job::class, 'targetAttribute' => ['id_job' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_job' => 'Id Job',
            'fio' => 'Fio',
            'family' => 'Family',
            'age' => 'Age',
            'childs' => 'Childs',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'id_job']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
