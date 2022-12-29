<?php

namespace App\Http\Livewire;

use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $total, $email, $telepon;

    public function mount()
    {
       if(!Auth::user()) {
        return redirect()->route('login');

        $product = Product::where('user_id', Auth::user()->id)->where('status'. 0)->first();
       }
    }

    public function checkout()
    {
        // dd('hai checkout');
        $this->validate([
            'email' => 'required',
            'telepon' => 'required'
        ]);

        //Simpan noHp Alamat ke data Users
        $Checkout = new Checkout();
        $Checkout->email = $this->email;
        $Checkout->telepon = $this->telepon;
        $Checkout->save();
        
        // //update data orders
        // // $orders = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // // $orders->status =1;
        // // $orders->update();

        // // $this->emit('keranjang');

        session()->flash('message', "Sukses Checkout");

        // return redirect()->route('history');
    }

    public function render()
    {
        return view('livewire.checkout-component');
    }
}
