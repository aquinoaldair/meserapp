<?php


namespace App\Http\Traits;
use App\Helpers\FileHelper;
use App\Models\Category;
use App\Models\Station;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Commerce\CommerceRepository;
use App\Repositories\Commerce\CommerceRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Station\StationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait RegisterCommerce
{
    private $user;
    private  $customer;
    private  $commerce;

    public function storeFullCustomer(UserRepositoryInterface $user, CustomerRepositoryInterface $customer, CommerceRepositoryInterface $commerce, array $data){

        $this->user = $user;
        $this->customer = $customer;
        $this->commerce = $commerce;



        $result = DB::transaction(function () use($data) {
            $user = $this->storeUser($data);
            $this->storeCustomer($data, $user->id);
            $commerce = $this->storeCommerce($data, $user->id);
            $this->storeStation($commerce->id);
            $this->storeCategoryDefault($commerce->id);
            return $user;
        });

       return $result ?? null;
    }

    public function storeCategoryDefault($commerce_id){
        $category = app(CategoryRepositoryInterface::class);
        $category->create([
            "name" => Category::DEFAULT_ROW,
            'commerce_id' => $commerce_id
        ]);
    }

    private function storeStation($commerce_id){
        $station = app(StationRepositoryInterface::class);
        $station->create([
            "name" => Station::DEFAULT_ROW,
            'commerce_id' => $commerce_id
        ]);
    }

    private function storeUser(array $data){
        return $this->user->createUserWithRole([
            'name' => $data['name'],
            'email' => $data["email"],
            'password' => $data["password"]
        ], User::CUSTOMER_ROLE);
    }

    private function storeCustomer(array $data, $user_id){
        return $this->customer->create([
            'user_id' => $user_id,
            'phone_number' => $data["phone_number"],
            'prefix_phone' => $data["prefix_phone"]
        ]);
    }

    private function storeCommerce(array $data, $user_id){
        return $this->commerce->create([
            'user_id' => $user_id,
            'name' => $data["name"],
            'date' => isset($data["date"]) ? $data["date"] : Carbon::now(),
            'logo' => (isset($data["logo"])) ? FileHelper::storage('commerce', $data["logo"]) : null,
            'address' => isset($data['address']) ? $data['address'] : null,
            'latitude' => isset($data['latitude']) ? $data['latitude'] : null,
            'longitude' => isset($data['longitude']) ?  $data['longitude'] : null
        ]);
    }
}
