<?php

namespace App\Providers;

use App\ChatgptGrammerCheckerService;
use App\EmailService;
use App\IGrammerChecker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind('A', EmailService::class);
        $this->app->bind('C', 'A');

        dd(resolve('C'), resolve('A'));

        // we can even pass a string for mapping that to a class or bind it to a class

        // here we have mapped string 'A' to EmailService
        // then we have mapped string 'C' to 'A'

        // service container first maps 'A' to EmailService
        // when it wants to map 'C' to 'A' it checks that 'A' is not a class
        // but when it checks that 'A' is mapped to EmailService, so, 'C' will be mapped to EmailService too
    }
}
