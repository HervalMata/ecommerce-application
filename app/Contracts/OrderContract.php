<?php


namespace App\Contracts;


interface OrderContract
{
    /**
     * @param $params
     * @return mixed
     */
    public function storeOrderDetails($params);
}
