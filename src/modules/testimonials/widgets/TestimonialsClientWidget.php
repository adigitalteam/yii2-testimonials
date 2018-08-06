<?php
/**
 * @author Jakhar <https://github.com/jakharbek>
 * @author Nazrullo <https://github.com/nazrullo>
 * @author O`tkir    <https://github.com/utkir24>
 * @team Adigitalteam <https://github.com/adigitalteam>
 * @package Testimonilals of Yii2
 *
 */

/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

/**
 * Created by PhpStorm.
 * User: utkir
 * Date: 03.08.2018
 * Time: 23:40
 */

namespace common\modules\testimonials\widgets;


use common\models\BlogPosts;
use common\modules\testimonials\forms\TestimonialsForm;

class TestimonialsClientWidget extends TestimonialsBaseWidget
{
    /**
     * @var ActiveRecord
     */
    public $model;

    public function run()
    {
        $form = new TestimonialsForm();

        $comments = $this->model->getTestimonials()
            ->orderBy(['parent_id' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $items = $this->treeRecursive($comments, null);

        return $this->render('comments/comments', [
            'post' => $this->model,
            'items' => $items,
            'commentForm' => $form,
        ]);
    }

}