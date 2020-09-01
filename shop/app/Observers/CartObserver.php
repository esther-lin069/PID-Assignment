<?php

namespace App\Observers;

use App\Cart;

class CartObserver
{
    /**
     * Handle the cart "created" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        //
    }

    /**
     * Handle the cart "updated" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function deleted(Cart $cart)
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function restored(Cart $cart)
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     *
     * @param  \App\Cart  $cart
     * @return void
     */
    public function forceDeleted(Cart $cart)
    {
        //
    }
}
