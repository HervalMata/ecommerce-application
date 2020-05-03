<?php


namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Models\Product;
use App\Traits\UploadAble;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    /**
     * @var Product
     */
    protected $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string[] $columns
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listProducts($columns = array('*'), string $order = 'id', string $sort = 'desc')
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {
        try {
            $collection = collect($params);
            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;
            $merge = $collection->merge(compact('status', 'featured'));
            $product = new Product($merge->all());
            $product->save();
            if ($collection->has('categories')) {
                $product->categories()->sync($params['categories']);
            }
            return $product;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params)
    {
        $product = $this->findProductById($params['id']);
        $collection = collect($params)->except('_token');
        $featured = $collection->has('featured') ? 1 : 0;
        $status = $collection->has('status') ? 1 : 0;
        $merge = $collection->merge(compact('status', 'featured'));
        $product->update($merge->all());
        if ($collection->has('categories')) {
            $product->categories()->sync($params['categories']);
        }
        return $product;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteProduct(int $id)
    {
        $product = $this->findProductById($id);
        $product->delete();
        return $product;
    }
}
