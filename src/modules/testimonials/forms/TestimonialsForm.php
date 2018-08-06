<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

namespace common\modules\testimonials\forms;

use yii\base\Model;

class TestimonialsForm extends Model
{
    public $parentId;
    public $text;

    public function rules()
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['parentId', 'integer'],
        ];
    }
}