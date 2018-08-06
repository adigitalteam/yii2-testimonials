<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */

namespace common\modules\testimonials\modules\admin\forms;

use common\modules\testimonials\models\Testimonials;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class TestimonialSearch extends Model
{
    public $id;
    public $text;
    public $active;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['text'], 'safe'],
            [['active'], 'boolean'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = Testimonials::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => function (Testimonials $testimonial) {
                return [
                    'id' => $testimonial->id

                ];
            },
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    public function activeList()
    {
        return [
            1 => Yii::$app->formatter->asBoolean(true),
            0 => Yii::$app->formatter->asBoolean(false),
        ];
    }
}
