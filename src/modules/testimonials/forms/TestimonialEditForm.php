<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */


namespace common\modules\testimonials\forms;


use common\modules\testimonials\models\Testimonials;
use yii\base\Model;

class TestimonialEditForm extends Model
{
    public $parentId;
    public $text;

    public function __construct(Testimonials $testimonial, $config = [])
    {
        $this->parentId = $testimonial->parent_id;
        $this->text = $testimonial->text;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['parentId', 'integer'],
        ];
    }
}