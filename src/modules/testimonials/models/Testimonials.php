<?php

namespace common\modules\testimonials\models;

use common\models\BlogPosts;
use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "testimonials".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $created_at
 * @property string $text
 * @property int $active
 *
 * @property Testimonials $parent
 * @property Testimonials[] $testimonials
 * @property BlogPosts $post
 * @property User $user
 */
class Testimonials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testimonials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'text', 'active'], 'required'],
            [['user_id', 'parent_id', 'created_at'], 'integer'],
            [['text'], 'string'],
            [['active'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Testimonials::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'parent_id' => 'Parent ID',
            'created_at' => 'Created At',
            'text' => 'Text',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Testimonials::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasOne(Testimonials::className(), ['parent_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonials::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasMany(BlogPosts::className(), ['id' => 'post_id'])->viaTable('post_testimonials',['testimonial_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function create($userId, $parentId, $text)
    {
        $review = new static();
        $review->user_id = $userId;
        $review->parent_id = $parentId;
        $review->text = $text;
        $review->created_at = time();
        $review->active = true;
        return $review;
    }

    public function edit($parentId, $text)
    {
        $this->parent_id = $parentId;
        $this->text = $text;
    }

    public function activate()
    {
        $this->active = true;
    }

    public function draft()
    {
        $this->active = false;
    }

    public function isActive()
    {
        return $this->active == true;
    }

    public function isIdEqualTo($id)
    {
        return $this->id == $id;
    }

    public function isChildOf($id)
    {
        return $this->parent_id == $id;
    }


    public function getId(){
        return $this->id;
    }


    /**
     * @return TestimonialsQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new TestimonialsQuery(get_called_class());
    }
}
