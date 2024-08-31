<?php

namespace App\Providers;

use App\ChatgptGrammerCheckerService;
use App\CopilotGrammerCheckerService;
use App\EmailService;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\TestController;
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

        # Contextual Binding:

        // if one interface is injected to controller A, inject some class
        // and if that interface is injected to controller B, inject another class :D

        // I want to get an object from CopilotGrammerCheckerService for ArticleController
        // & an object from ChatgptGrammerCheckerService for PostController.

        $this->app->when(ArticleController::class)
            ->needs(IGrammerChecker::class)
            ->give(CopilotGrammerCheckerService::class);

        $this->app->when(PostController::class)
            ->needs(IGrammerChecker::class)
            ->give(ChatgptGrammerCheckerService::class);

        
        // you can pass an array of controllers:
        $this->app->when([TestController::class, Test2Controller::class])
            ->needs(IGrammerChecker::class)
            ->give(ChatgptGrammerCheckerService::class);

        /*
            imagine you need an object from PaypalPaymentService for BookController
            and customers should pay for the books for Paypal
            and you need and object from MasterCardPaymentService for ProductController
            ==> customers should pay for products with master card
        */

        // app()->bind(IGrammerChecker::class, CopilotGrammerCheckerService::class);
        // above code just gives an instance from CopilotGrammerCheckerService to both controllers :D

        // ===================================================================

        /*
            if ArticleController is like this:
            public function __construct(private string $token){}

            if PostController is like this:
            public function __construct(private string $token){}

            I want give config('app.cipher') to $token of ArticleController
            and give config('app.locale') to $token of PostController
        */

        $this->app->when(ArticleController::class)
            ->needs('$token')
            ->give(config('app.cipher'));

        $this->app->when(PostController::class)
            ->needs('$token')
            ->give(config('app.locale'));
    }
}
