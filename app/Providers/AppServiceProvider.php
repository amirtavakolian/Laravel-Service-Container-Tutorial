<?php

namespace App\Providers;

use App\ChatgptService;
use App\EmailService;
use App\GrammerCheckerService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        // first read "diffrents between resolve and app.txt"

        // ============================================================

        # simple example of using bind ==> bind a string to a work
        # string amir to return 'hi, im amir' work

        # Ex: I tell my brother to pay the money of dinner ==> string: pay-dinner-price
        # now my brother must do several works: get to the cachier, put of his wallet, give his atm card, tell his password
        # so, we bind only one string (pay-dinner-price) to these several works.

        // so, you can prepare a task in advance, and call that task wherever you want ==> use bind()

        $this->app->bind('amir', function (Application $app) {
            return 'hi, im amir';
        });

        dump(app('amir'));  // it does the work we have defined ==> return 'hi, im amir';
        dump(resolve('amir')); // it does the work we have defined ==> return 'hi, im amir';

        // so, in any place in your project, when ever you resolve amir, it returns a string 'hi, im amir'

        // --------------------------------------------------------------

        $this->app->bind('log-something', function () {
            Log::info('log this text for me');
            // send email
            // query to database
            // cache something
            // :))
            return 'logging has been done';
        });

        // you can do any work you want before or after Logging or doing payment :D 

        dump(resolve('log-something'));  // it does the work we have defined in above
        dump(app('log-something'));  // it does the work we have defined in above

        // =============================================================

        // now, we want to bind the 'creating object from ChatgptService' task to a string :D

        // if you create object from a class in 100 places in your project using 'new' keyword,
        // if you want to make changes in parameter of the class, you have to manually make changes
        // in all the places you have used 'new' keyword.

        // so, use service container ==> pass the responsibility of creating object to service container.
        // no need to make changes in your codes anymore

        // ================================================================

        // below code is the refactor version of the previous commit's code:
        // use below code if the value of the parameters of fixed and not change
        // its more clear than the previous commit's code

        $this->app->bind(ChatgptService::class, function () {
            return new ChatgptService('random-token-1');
        });

        $this->app->bind(GrammerCheckerService::class, function () {
            return new GrammerCheckerService('random-token-2', $this->app->make(ChatgptService::class));
        });

        $this->app->bind(EmailService::class, function () {
            return new EmailService('email-title', $this->app->make(GrammerCheckerService::class));
        });

        // ==========================================================================

        // use below code if the parameters are not fixed and change, each time we need an instance from the service

        $emailService = resolve(EmailService::class,
            ['title' => 'a random title',
                'grammerCheckerService' => resolve(GrammerCheckerService::class,
                    ['token' => 'random-token-1',
                        'chatgptService' => resolve(ChatgptService::class, ['token' => 'random-token-2'])])
            ]);

        // you can even

        $emailService1 = app(EmailService::class,
            ['title' => 'a random title',
                'grammerCheckerService' => resolve(GrammerCheckerService::class,
                    ['token' => 'random-token-1',
                        'chatgptService' => resolve(ChatgptService::class, ['token' => 'random-token-2'])])
            ]);


        // ==========================================================================

        // traditional way in php pure:
        $emailService = new EmailService('title', new GrammerCheckerService('token', new ChatgptService('token')));

    }
}
