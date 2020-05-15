<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRegisterCommerce extends Component
{
    public $title;

    public $route;

    public $register;

    public function __construct($title, $route, $register)
    {
        $this->title = $title;
        $this->route = $route;
        $this->register = $register;
    }

    public function render()
    {
        return view('components.form-register-commerce');
    }
}
