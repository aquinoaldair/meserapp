<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController
{

    public function index(){

       if ($this->user->isAdmin()){
           return view('dashboard.admin');
       }

       if ($this->user->isCustomer()){
           return view('dashboard.customer');
       }

        return view('dashboard.index');

    }
}
