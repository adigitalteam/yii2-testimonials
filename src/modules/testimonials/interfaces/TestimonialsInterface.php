<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

namespace common\modules\testimonials\interfaces;


/**
 * Interface TestimonialsInterface
 * @package common\modules\testimonials\interfaces
 */
interface TestimonialsInterface
{
    /**
     * @param $comments
     * @param $parentId
     * @return mixed
     */
    public function treeRecursive(&$comments, $parentId);

}