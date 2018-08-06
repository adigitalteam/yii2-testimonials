<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Testimonials of Yii2
 */

namespace common\modules\testimonials\behaviors;

use common\modules\testimonials\models\Testimonials;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * Class TestimonialsBehavior
 * @package common\modules\testimonials\behaviors
 * @property $owner Component|null the owner of this behavior
 */
class TestimonialsBehavior extends Behavior
{

    public $relation_name = 'testimonials';

    /**
     * @param $userId
     * @param $parentId
     * @param $text
     * @return Testimonials
     */
    public function addTestimonials($userId, $parentId, $text)
    {
        $parent = $parentId ? $this->getTestimonial($parentId) : null;
        if ($parent && !$parent->isActive()) {
            throw new \DomainException($this->getExceptionMessage('notAdd'));
        }
        $testimonials = $this->getOwnerTestimonials();
        $testimonials[] = $testimonial = Testimonials::create($userId, $parent ? $parent->getId() : null, $text);
        $this->updateTestimonials($testimonials);
        return $testimonial;
    }

    /**
     * @param $id
     * @param $parentId
     * @param $text
     */
    public function editTestimonial($id, $parentId, $text)
    {
        $parent = $parentId ? $this->getTestimonial($parentId) : null;
        $testimonials = $this->getOwnerTestimonials() ;
        foreach ($testimonials as $testimonial) {
            if ($testimonial->isIdEqualTo($id)) {
                $testimonial->edit($parent ? $parent->getId() : null, $text);
                $this->updateTestimonials($testimonials);
                return;
            }
        }
        throw new \DomainException($this->getExceptionMessage('notFound'));
    }

    /**
     * @param $id
     */
    public function activateTestimonial($id)
    {
        $testimonials = $this->getOwnerTestimonials();
        foreach ($testimonials as $testimonial) {
            if ($testimonial->isIdEqualTo($id)) {
                $testimonial->activate();
                $this->updateTestimonials($testimonials);
                return;
            }
        }
        throw new \DomainException($this->getExceptionMessage('notFound'));
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function removeTestimonial($id)
    {
        $testimonials = $this->getOwnerTestimonials();
        foreach ($testimonials as $i => $testimonial) {
            if ($testimonial->isIdEqualTo($id)) {
                if ($this->hasChildren($testimonial->getId())) {
                    foreach ( $testimonials as $index => $current){
                        if($current->isChildOf($testimonial->getId())){
                            unset($testimonials[$index]);
                        }
                    }
                }
                unset($testimonials[$i]);
                $this->updateTestimonials($testimonials);
                $testimonial->delete();
                return;
            }
        }
        throw new \DomainException($this->getExceptionMessage('notFound'));
    }

    /**
     * @param $id
     * @return Testimonials
     */
    public function getTestimonial($id)
    {
        foreach ($this->getOwnerTestimonials() as $testimonial) {
            if ($testimonial->isIdEqualTo($id)) {
                return $testimonial;
            }
        }
        throw new \DomainException($this->getExceptionMessage('notFound'));
    }

    /**
     * @param $id
     * @return bool
     */
    private function hasChildren($id)
    {
        foreach ($this->getOwnerTestimonials() as $testimonial) {
            if ($testimonial->isChildOf($id)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $testimonials
     */
    private function updateTestimonials(array $testimonials)
    {
        $this->owner->{$this->relation_name} = $testimonials;
        $this->owner->save();
    }

    /**
     * @return Testimonials[]
     */
    public function getOwnerTestimonials()
    {
        return $this->owner->{$this->relation_name};
    }

    /**
     * @return array
     */
    protected static function ExceptionMessages(){
        return [
            'notFound' => 'Testimonial is not found.',
            'notAdd'  => 'Cannot add testimonial to inactive parent.'
        ];
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getExceptionMessage($name)
    {
        return ArrayHelper::getValue(self::ExceptionMessages(), $name);
    }


}