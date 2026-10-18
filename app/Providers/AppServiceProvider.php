<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (Schema::hasTable('categories')) {
                view()->share('categories', Category::all());
            } else {
                view()->share('categories', collect());
            }
        } catch (\Exception $e) {
            view()->share('categories', collect());
        }
    }
}
