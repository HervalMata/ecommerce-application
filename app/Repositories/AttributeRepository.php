<?php


namespace App\Repositories;


use App\Contracts\AttributeContract;
use App\Models\Attribute;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AttributeRepository extends BaseRepository implements AttributeContract
{

    /**
     * @var Attribute
     */
    protected $model;

    /**
     * AttributeRepository constructor.
     * @param Attribute $model
     */
    public function __construct(Attribute $model)
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
    public function listAttributes($columns = array('*'), string $order = 'id', string $sort = 'desc')
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findAttributeById(int $id)
    {
        try {
            return $this->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Attribute|mixed
     */
    public function createAttribute(array $params)
    {
        try {
            $collection = collect($params);
            $is_filterable = $collection->has('is_filterable') ? 1 : 0;
            $is_required = $collection->has('is_required') ? 1 : 0;

            $merge = $collection->merge(compact('is_filterable', 'is_required'));
            $attribute = new Attribute($merge->all());
            $attribute->save();
            return $attribute;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAttribute(array $params)
    {
        $attribute = $this->findAttributeById($params['id']);
        $collection = collect($params)->except('_token');
        $is_filterable = $collection->has('is_filterable') ? 1 : 0;
        $is_required = $collection->has('is_required') ? 1 : 0;

        $merge = $collection->merge(compact('is_filterable', 'is_required'));
        $attribute->update($merge->all());
        return $attribute;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteAttribute(int $id)
    {
        $attribute = $this->findAttributeById($id);
        $attribute->delete();
        return $attribute;
    }
}
