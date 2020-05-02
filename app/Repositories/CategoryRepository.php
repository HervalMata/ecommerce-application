<?php


namespace App\Repositories;


use App\Contracts\CategoryContract;
use App\Models\Category;
use App\Traits\UploadAble;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;

class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;

    protected $model;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
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
    public function listCategories($columns = array('*'), string $order = 'id', string $sort = 'desc')
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id)
    {
        try {
            return $this->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createCategory(array $params)
    {
        try {
            $collection = collect($params);
            $image = null;
            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'categories');
            }
            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;
            $merge = $collection->merge(compact('menu', 'image', 'featured'));
            $category = new Category($merge->all());
            $category->save();
            return $category;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params)
    {
        $category = $this->findCategoryById($params['id']);
        $collection = collect($params)->except('_token');
        if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
            if ($category->image != null) {
                $this->deleteOne($category->image);
            }
            $image = $this->uploadOne($params['image'], 'categories');
        }
        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;
        $merge = $collection->merge(compact('menu', 'image', 'featured'));
        $category->update($merge->all());
        return $category;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteCategory(int $id)
    {
        $category = $this->findCategoryById($id);
        if ($category->image != null) {
            $this->deleteOne($category->image);
        }
        $category->delete();
        return $category;
    }
}
