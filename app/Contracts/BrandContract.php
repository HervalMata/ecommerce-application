<?php


namespace App\Contracts;


interface BrandContract
{
    /**
     * @param string[] $columns
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listBrands($columns = array('*'), string $order = 'id', string $sort = 'desc');

    /**
     * @param int $id
     * @return mixed
     */
    public function findBrandById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBrand(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBrand(array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteBrand(int $id);
}
