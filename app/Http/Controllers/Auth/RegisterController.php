<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\RegisterCommerce;
use App\Mail\WelcomeMail;
use App\Providers\RouteServiceProvider;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    private $user;
    private $commerce;
    private $customer;

    use RegistersUsers, RegisterCommerce;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct(UserRepositoryInterface $user, CommerceRepositoryInterface $commerce, CustomerRepositoryInterface $customer)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->commerce = $commerce;
        $this->customer = $customer;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'prefix_phone' => ['required', 'integer', 'digits_between:1,5'],
            'phone_number' => ['required', 'integer', 'digits_between:5,12'],
            'address' => ['string', 'max:255'],
            'latitude' => ['required_with:address'],
            'longitude' => ['required_with:address']
        ]);
    }


    protected function create(array $data)
    {
        $user =  $this->storeFullCustomer($this->user, $this->customer, $this->commerce, $data);

        if (!$user){
            redirect()->back()->with('error', "Hubo un error al crear el registro");
        }

        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }


        return $user;
    }

}
