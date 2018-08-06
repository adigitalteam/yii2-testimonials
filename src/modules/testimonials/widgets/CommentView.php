<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */
namespace common\modules\testimonials\widgets;

use common\modules\testimonials\models\Testimonials;

class CommentView
{
    public $comment;
    /**
     * @var self[]
     */
    public $children;

    public function __construct(Testimonials $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}