<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getOrders()
    {
        $orders = auth()->user()->orders;
        return view('site.pages.account.orders', compact('orders'));
    }
}
