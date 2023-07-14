<?php

use Product;

class Home extends Controller
{
    public function index()
    {
        $product = new Product();
        $this->loadView("product_list_page", ["products" => $product->index()]);
    }

}
