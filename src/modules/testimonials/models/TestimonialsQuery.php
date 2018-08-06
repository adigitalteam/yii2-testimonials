<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

namespace common\modules\testimonials\models;


use yii\db\ActiveQuery;

/**
 * Class TestimonialsQuery
 * @package common\modules\testimonials\models
 */
class TestimonialsQuery extends ActiveQuery
{

    /**
     * @return TestimonialsQuery
     */
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

    /**
     * @param array $array
     * @return TestimonialsQuery
     */
    public function sort(array $array)
    {
        return $this->orderBy($array);
    }

    /**
     * @param null $db
     * @return array|\yii\db\ActiveRecord[]
     */
    public function all($db = null)
    {
        return parent::all($db); // TODO: Change the autogenerated stub
    }

    /**
     * @param null $db
     * @return array|null|\yii\db\ActiveRecord
     */
    public function one($db = null)
    {
        return parent::one($db); // TODO: Change the autogenerated stub
    }


}