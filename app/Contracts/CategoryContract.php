<?php


namespace App\Contracts;


interface CategoryContract extends BaseContract
{
    /**
     * @param string[] $columns
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listCategories($columns = array('*'), string $order = 'id', string $sort = 'desc');

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteCategory(int $id);

    /**
     * @return mixed
     */
    public function treeList();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);
}
