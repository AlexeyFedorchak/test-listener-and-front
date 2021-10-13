<?php

namespace Parsers;

class PayPalResponseParser implements IParser
{
    protected $curlResult;

    public function __construct($curlResult)
    {
        $this->curlResult = $curlResult;
    }

    /**
     * @return void
     */
    public function parse(): void
    {
        $stream = fopen('notifications_paypal.csv', 'a');
        fputcsv($stream, $_POST);
    }
}
