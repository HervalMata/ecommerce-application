<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function getCart()
    {
        return view('site.pages.cart');
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function removeItem($id)
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }

        return redirect()->back()->with('message', 'Item removido do carrinho com sucesso.');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function clearCart()
    {
        Cart::clear();
        return redirect('/');
    }
}
