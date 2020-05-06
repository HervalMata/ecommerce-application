<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderContract
     */
    private $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderContract $orderRepository
     */
    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = $this->orderRepository->listOrders();
        $this->setTitle('Ordens', 'Lista de todas as ordens');
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * @param $orderNumber
     * @return Application|Factory|View
     */
    public function show($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);
        $this->setTitle('Dethales das Ordens', $orderNumber);
        return view('admin.orders.show', compact('order'));
    }


}
