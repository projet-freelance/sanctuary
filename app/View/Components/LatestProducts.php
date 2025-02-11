<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class LatestProducts extends Component
{
    public $categories;

    public function __construct()
    {
        $this->categories = Product::select('category')->distinct()->get()->pluck('category');
    }

    public function render()
    {
        return view('components.latest-products', ['categories' => $this->categories]);
    }
}
