<?php

namespace App;

class EmailService
{
    public function __construct(public string $title, private IGrammerChecker $grammerCheckerService)
    {
    }

    public function send()
    {
        echo "sending email...";
    }
}
