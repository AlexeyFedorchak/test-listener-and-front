<?php

namespace Validators;

use Parsers\IParser;
use Parsers\PayPalResponseParser;

class PayPalIPNValidator implements IValidator
{
    protected $request;

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return IParser
     * @throws \BadValidationRequest
     */
    public function validate(): IParser
    {
        $ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        if (!($res = curl_exec($ch))) {
            curl_close($ch);

            throw new \BadValidationRequest('Error on validating the request');
        }

        if (strcmp ($res, "VERIFIED") == 0) {
            return new PayPalResponseParser($res);
        }

        throw new \BadValidationRequest('Error on validating the request');
    }
}
