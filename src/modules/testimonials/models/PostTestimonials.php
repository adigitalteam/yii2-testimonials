<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */



namespace common\modules\testimonials\models;


use common\models\BlogPosts;
use yii\db\ActiveRecord;

/**
 * Class PostTestimonials
 * @package common\modules\testimonials\models
 */
class PostTestimonials extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%post_testimonials}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['post_id','testimonial_id'],'required'],
            ['post_id','exist','targetClass' => BlogPosts::className(),'targetAttribute' => ['id'=>'post_id']],
            ['testimonial_id','exist','targetClass' => Testimonials::className(),'targetAttribute' => ['id'=>'testimonial_id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost(){
        return $this->hasOne(BlogPosts::className(),['id'=>'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestimonial(){
        return $this->hasOne(Testimonials::className(),['id'=>'testimonial_id']);
    }

}