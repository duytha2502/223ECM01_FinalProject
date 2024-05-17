<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;


class ProductComponent extends Component
{
    public $sorting;

    public function mount() {
        $this->sorting = "default";
    }

    use WithPagination;

    public function render()
    {
        if(this->sorting=='price') 
        {
            $product = Product::orderBy('price', 'DESC')->paginate(8);
        }else if($this->sorting=='price-desc')
        {
            $product = Product::orderBy('price-desc', 'DESC')->paginate(8);
        }

        return view('livewire.mall-cart', ['products' => $product])->layout("layouts.app");
    }
}
