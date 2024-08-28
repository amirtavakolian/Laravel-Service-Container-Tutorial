<?php

namespace App;

class EmailService
{

    public function __construct(public string $title)
    {
    }

    public function send()
    {
        echo "sending email...";
    }
}
