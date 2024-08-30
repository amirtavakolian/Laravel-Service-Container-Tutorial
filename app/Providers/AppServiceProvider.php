<?php

namespace App\Providers;

use App\ChatgptGrammerCheckerService;
use App\EmailService;
use App\GrammerCheckerService;
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
        # binding interface or abstract:
        // imagine you have several grammer checker like chatgpt grammer checker, copilot, gemini &...
        // use service container to bind interface so, you can easily change the grammer checker service
        // in your controller or where ever you need grammer checker service.

        $this->app->bind(IGrammerChecker::class, ChatgptGrammerCheckerService::class);

        // now in your controller do like this:
        // __construct(private IGrammerChecker $grammerCheckerService){}
        // or you can use resolve() or app() in the methods of your controller.

        // ==========================================================================

        /*
        until now we have type hinted classes, and service container read the type hints and
        create an object for us

        but, what if we type hint interface or abstract classes?
        service container must create object from classes which have implemented that interface or extend that abstract
        but how service container can make object from them?

        we have to define classes which service container should create object from
        when we type hint an interface or an abstract
        */

        // ================================================================================

        # First method:

        $emailService = resolve(EmailService::class, ['title' => 'random title',
            'grammerCheckerService' => resolve(ChatgptGrammerCheckerService::class)]);

        // it's a good method but, we want service container inject the dependency automatically
        // when we type hint an inteface or an abstract.

        // ================================================================================

        # Seconde Method:

        $this->app->bind(IGrammerChecker::class, ChatgptGrammerCheckerService::class);
        $emailService1 = resolve(EmailService::class, ['title' => 'my title']);

        // now, service container knows that when a class has dependency on IGrammerCheckerwhich, from its type hint,
        // which class it should create object from and return us

        // Ex: when ever a class has dependecy on IGrammerChecker::class, create an object from ChatgptGrammerCheckerService

        # notice:
        # here ChatgptGrammerCheckerService has a $token parameter in constructor which we have gave default value.

        // ------------------------------------------------

        # how to pass a value to $token parameter of ChatgptGrammerCheckerService:

        $this->app->bind(IGrammerChecker::class, function () {
            return new ChatgptGrammerCheckerService('random-token');

            // here you can read from config or env
            // you can query to database
            // and what ever you need to do

        });
        $emailService2 = resolve(EmailService::class, ['title' => 'my title']);

        dd($emailService2);

        // ================================================================================


    }
}
