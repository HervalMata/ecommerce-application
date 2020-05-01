<?php


namespace App\Contracts;


interface BaseContract
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * @param string[] $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id);

    /**
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function findByOrFail(array $data);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
