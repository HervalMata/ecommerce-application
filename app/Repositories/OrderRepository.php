<?php


namespace App\Repositories;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository implements \App\Contracts\OrderContract
{
    /**
     * OrderRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function storeOrderDetails($params)
    {
        $order = Order::create([
            'order_number' => 'ORD-'. strtoupper(uniqid()),
            'user_id'  => auth()->user()->id,
            'status' => 'pending',
            'grand_total' => Cart::getSubTotal(),
            'item_count'  => Cart::getTotalQuantity(),
            'payment_status' => 0,
            'payment_method' => null,
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'address' => $params['address'],
            'city' => $params['city'],
            'country' => $params['country'],
            'post_code' => $params['post_code'],
            'phone_number' => $params['phone_number'],
            'notes' => $params['notes']
        ]);
        if ($order) {
            $items = Cart::getContent();
            foreach ($items as $item)
            {
                $product = Product::where('name', $item->name)->first();
                $orderItem = new OrderItem([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->getPriceSum(),
                ]);
                $order->items()->save($orderItem);
            }
        }
        return $order;
    }
}
