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


namespace common\modules\testimonials\widgets;


use common\modules\testimonials\forms\TestimonialsForm;
use yii\db\ActiveRecord;

class TestimonialsAdminWidget extends TestimonialsBaseWidget
{
    /**
     * @var ActiveRecord
     */
    public $model;
    public $template;

    public $relation_name = 'testimonials';

    public function run()
    {
        $form = new TestimonialsForm();

        $comments = $this->model->{$this->relation}()
            ->sort(['parent_id' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $items = $this->treeRecursive($comments, null);

        return $this->render('comments/admin-comments', [
            'model' => $this->model,
            'items' => $items,
            'commentForm' => $form,
        ]);
    }

    public function getRelation(){
       return  'get'.ucfirst($this->relation_name);
    }


}