<?php


namespace App\Contracts;


interface AttributeContract
{
    /**
     * @param string[] $columns
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listAttributes($columns = array('*'), string $order = 'id', string $sort = 'desc');

    /**
     * @param int $id
     * @return mixed
     */
    public function findAttributeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createAttribute(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateAttribute(array $params);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteAttribute(int $id);
}
