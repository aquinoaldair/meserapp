<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Product;
use App\Models\Room;
use App\Models\Station;
use App\Models\Supplier;
use App\Policies\CategoryPolicy;
use App\Policies\CostPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RoomPolicy;
use App\Policies\StationPolicy;
use App\Policies\SupplierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Room::class => RoomPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Cost::class => CostPolicy::class,
        Station::class => StationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
