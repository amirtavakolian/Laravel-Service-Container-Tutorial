<?php

namespace App\Providers;

use App\EmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // what if our classes have parameter in constructor:

        $emailServicee = new EmailService('a random title'); // traditional way in php pure

        $emailService = resolve(EmailService::class, ['title' => 'a random title']); // pass param using service container

        dd($emailServicee->title, $emailService->title);

        // pas the parameter of constructor like above

        // ============================================================
        // ============================================================

        $emailService1 = resolve(EmailService::class, ['title' => 'a random title']);

        $emailService2 = resolve(EmailService::class, ['title' => 'a random title']);

        $emailService3 = resolve(EmailService::class, ['title' => 'a random title']);

        $emailService4 = resolve(EmailService::class, ['title' => 'a random title']);

        dd($emailService1, $emailService2, $emailService3, $emailService4);

        // above code creates 4 diffrent objects and fill the title property
    }
}
