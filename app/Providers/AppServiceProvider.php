<?php

namespace App\Providers;

use App\Models\ChMessage;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $messagesCount = ChMessage::where('to_id', auth()->id())
                                           ->count();
            $view->with('messagesCount', $messagesCount);
        });
    }
}
