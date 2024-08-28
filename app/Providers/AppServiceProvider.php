<?php

namespace App\Providers;

use App\ChatgptService;
use App\EmailService;
use App\GrammerCheckerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        # Important #
        // below code is not clean ==> it's not a good way for using.
        // just read it, do not use it in your projects.
        // in next commit i have said the correct way.

        // ===============================================================

        # just remember, resolve uses service container to create object and return.

        // ================================================================

        // traditional way in php pure:
        $emailServicee = new EmailService('a simple title', new GrammerCheckerService('my-token', new ChatgptService('random-token')));

        $emailService1 = resolve(EmailService::class, ['title' => 'a simple title',
            'grammerCheckerService' => resolve(GrammerCheckerService::class, ['token' => 'my-Token',
                'chatgptService' => resolve(ChatgptService::class, ['token' => 'random-token'])
            ])
        ]);

        dd($emailService1);

        /*
         # remmember: laravel service container checks the paramters of the classes constructor in resolving process.
                      if they have dependencies on other classes, it will resolve them (if we provide required paramters)

           now, even if the dependencies of a class, has dependency to other classes, service container will check them
           and resolve them if we provide required paramters.

           so ==> service container, recursively, checks all the dependencies of classes
                  and even the dependencies of the dependencies of classes and resolve them
                  if we provide required paramters.

        */

    }
}
