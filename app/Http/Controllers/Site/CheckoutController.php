<?php

namespace App\Http\Controllers\Site;

use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PaypalService;
use Darryldecode\Cart\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

class CheckoutController extends Controller
{
    /**
     * @var OrderContract
     */
    protected $orderRepository;
    /**
     * @var PaypalService
     */
    private $paypal;

    /**
     * CheckoutController constructor.
     * @param OrderContract $orderRepository
     * @param PaypalService $paypal
     */
    public function __construct(OrderContract $orderRepository, PaypalService $paypal)
    {
        $this->orderRepository = $orderRepository;
        $this->paypal = $paypal;
    }

    /**
     * @return Application|Factory|View
     */
    public function getCheckout()
    {
        return view('site.pages.checkout');
    }

    /**
     * @param Request $request
     */
    public function placeOrder(Request $request)
    {
        $order = $this->orderRepository->storeOrderDetails($request->all());
        if ($order) {
            $this->paypal->processPayment($order);
        }
        return redirect()->back()->with('message', 'Ordem não localizada.');
    }



    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('payerId');
        $status = $this->paypal->completePayment($paymentId, $payerId);
        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'Paypal -' . $status['salesId'];
        $order->save();
        Cart::clear();
        return view('site.pages.success', compact('order'));
    }
}
