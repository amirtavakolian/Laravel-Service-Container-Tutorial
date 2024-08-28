<?php

namespace App;

class EmailService
{

    public function __construct(public string $title, GrammerCheckerService $grammerCheckerService)
    {
    }

    public function send()
    {
        echo "sending email...";
    }
}
