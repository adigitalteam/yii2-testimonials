<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */
namespace common\modules\testimonials\widgets;

use common\modules\testimonials\interfaces\TestimonialsInterface;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * Class TestimonialsBaseWidget
 * @package common\modules\testimonials\widgets
 */
class TestimonialsBaseWidget extends Widget implements TestimonialsInterface
{
    /**
     * @var null
     */
    public $model = null;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->model) {
            throw new InvalidConfigException('Specify the post.');
        }
    }

    /**
     * @param integer $parentId
     * @return CommentView[]
     */
    public function treeRecursive(&$comments, $parentId)
    {
        $items = [];
        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $items[] = new CommentView($comment, $this->treeRecursive($comments, $comment->id));
            }
        }
        return $items;
    }

}
