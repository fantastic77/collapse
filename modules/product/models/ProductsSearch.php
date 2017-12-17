<?php

namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\product\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\modules\product\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public $categoryName;
    public $priceRange;
    public $min_price;
    public $max_price;

    public function rules()
    {
        return [
            [['id', 'categoryId', 'price'], 'integer'],
            [['name', 'categoryName', 'priceRange'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['products.id' => SORT_ASC],
                    'desc' => ['products.id' => SORT_DESC],
                    'label' => 'Products ID',
                    'default' => SORT_ASC
                ],
                'name' => [
                    'asc' => ['products.name' => SORT_ASC],
                    'desc' => ['products.name' => SORT_DESC],
                    'label' => 'Products Name',
                ],
                'price' => [
                    'asc' => ['products.price' => SORT_ASC],
                    'desc' => ['products.price' => SORT_DESC],
                    'label' => 'Products Price in UAH',
                ],
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'categoryId' => $this->categoryId,
            'price' => $this->price,
        ]);

        $this->priceRange = explode(",", $this->priceRange);
        $this->min_price = $this->priceRange[0];
        $this->max_price = $this->priceRange[1];
        $this->priceRange = implode(",", $this->priceRange);
        if ($this->max_price == 1000) $this->max_price = null;

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['>', 'price', $this->min_price]);
        $query->andFilterWhere(['<', 'price', $this->max_price]);

//        $query->joinWith(['category']);

        return $dataProvider;
    }
}
