<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormUpdateCommerce extends Component
{
    public $title;

    public $route;

    public  $commerce;

    public function __construct($title, $route, $commerce)
    {
        $this->title = $title;
        $this->route = $route;
        $this->commerce = $commerce;
    }

    public function render()
    {
        return view('components.form-update-commerce');
    }
}
