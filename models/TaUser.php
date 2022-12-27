<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ta_user".
 *
 * @property int $id
 * @property int|null $created_by
 * @property string|null $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $tagroup_id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $auth_key
 * @property string|null $last_login
 * @property string $status
 * @property string|null $access_token
 * @property string|null $nama_lengkap
 * @property string|null $email
 *
 * @property TaGroup $tagroup
 */
class TaUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'tagroup_id'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'tagroup_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['last_login'], 'string'],
            [['username', 'auth_key', 'access_token'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['nama_lengkap'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['tagroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaGroup::class, 'targetAttribute' => ['tagroup_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'tagroup_id' => 'Tagroup ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'last_login' => 'Last Login',
            'status' => 'Status',
            'access_token' => 'Access Token',
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Tagroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTagroup()
    {
        return $this->hasOne(TaGroup::class, ['id' => 'tagroup_id']);
    }
}
