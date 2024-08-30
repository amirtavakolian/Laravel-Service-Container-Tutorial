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

        // Singletone:

        $this->app->bind(IGrammerChecker::class, ChatgptGrammerCheckerService::class);

        $service1 = resolve(EmailService::class);
        $service2 = resolve(EmailService::class);
        $service3 = resolve(EmailService::class);

        dump($service1, $service2, $service3);

        /*
        if you see the result of dd($service1, $service2, $service3) you will see this:

        App\EmailService^ {#283
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#284
            -token: ""
          }
        } // app\Providers\AppServiceProvider.php:29
        App\EmailService^ {#285
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#286
            -token: ""
          }
        } // app\Providers\AppServiceProvider.php:29
        App\EmailService^ {#287
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#288
            -token: ""
          }
        }

        look at the object ids of EmailService ==> #283 #285 #287
        & look at the grammerCheckerService object ids ==> #284 #286 #288

        all the ids are not same so it means that SC has created diffrent objects
        from EmailService & GrammerCheckerService for us

        */

        // ===============================================================================

        $this->app->bind(IGrammerChecker::class, ChatgptGrammerCheckerService::class, true);

        $service1 = resolve(EmailService::class);
        $service2 = resolve(EmailService::class);
        $service3 = resolve(EmailService::class);

        dd($service1, $service2, $service3);

        /*

        App\EmailService^ {#299
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#295
            -token: ""
          }
        } // app\Providers\AppServiceProvider.php:64
        App\EmailService^ {#291
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#295
            -token: ""
          }
        } // app\Providers\AppServiceProvider.php:64
        App\EmailService^ {#284
          -grammerCheckerService: App\ChatgptGrammerCheckerService^ {#295
            -token: ""
          }
        }

        as you see, the objects which SC has created for us from ChatgptGrammerCheckerService has same id

        it's because of the "shared" parameter of bind() which we have set it to true ==> singletone

        it means SC has created only one object from ChatgptGrammerCheckerService for us. (it's construct called only once)
        all $service1, $service2, $service3 variables are pointing to one object ==> references to one object. ===>
        one human with 3 names.

        SC creates one object for the first time, and keeps the reference to that object.
        for next times that you use app() or resolve() to get an object from a class,
        SC just returns the reference to that object and not create a new object anymore.

        $this->app->singleton(Foo::class, Bazz::class);
        $service = resolve(Foo::class);

        it's the implementation of singleton desing pattern

        # why should we use singleton design pattern:
        some processes are time-consuming or heavy to be done
        Ex: connecting to database.

        so, whenever we wana create object from database class, this process must be done which takes
        time, ram & etc... ==> fucks the performance of our software

        so, we can use singleton ==> create object once, store it somewhere, each time we need an object from
        database class, return the created object & don't create new object (better performance)

        so there is no need to filling the ram with repetitive objects.

        SC has singleton() method which binds the class only once

        one its disadvantages is the created object will not change anymore untill we reset our software.
        but its advantage is, there is no need to resolve anytime we need an object from database class
        ==> better performance.

         */
    }
}
