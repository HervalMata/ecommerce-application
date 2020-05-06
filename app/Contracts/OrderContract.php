<?php


namespace App\Contracts;


interface OrderContract
{
    /**
     * @param $params
     * @return mixed
     */
    public function storeOrderDetails($params);

    /**
     * @param string $order
     * @param string $sort
     * @param array|string[] $columns
     * @return mixed
     */
    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param $orderNumber
     * @return mixed
     */
    public function findOrderByNumber($orderNumber);
}
