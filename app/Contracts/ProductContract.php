<?php


namespace App\Contracts;


interface ProductContract
{
    /**
     * @param string[] $columns
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listProducts($columns = array('*'), string $order = 'id', string $sort = 'desc');

    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createProduct(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteProduct(int $id);
}
