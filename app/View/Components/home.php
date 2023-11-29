<?php

namespace App\View\Components;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\View\Component;

class home extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $category = Category::all();
        $banner = Banner::all();
        $post = Post::orderByDesc('id')->get();
        $new_product = Product::orderByDesc('id')->take(8)->get();
        return view('components.home',compact(['category','banner','post','new_product']));
    }
}
