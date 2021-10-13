<?php
//this is where request from PayPal webhook is handled

(new \Listeners\PayPalListener())
    ->listen()
    ->validate()
    ->parse();
