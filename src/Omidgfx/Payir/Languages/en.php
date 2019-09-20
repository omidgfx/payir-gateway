<?php namespace Omidgfx\Payir\Languages;

use Omidgfx\Payir\Language;

class en extends Language
{

    /**
     * @return array
     */
    protected function send_errors() {
        return [
            "-1"     => 'Api is required',
            "-2"     => 'Amount is required',
            "-3"     => 'Amount must be an integer',
            "-4"     => 'Amount must be greater than or equal to 1000 rials',
            "-5"     => 'The return url (redirect) is required',
            "-6"     => 'No payment gateway found for your Api or the payment gateway is disabled',
            "-7"     => 'Merchant is disabled',
            "-8"     => 'The return url (redirect) is not on same domain with your verified payment gateways',
            "-12"    => 'Description length is longer than 255 character',
            "failed" => 'Transaction has been failed',
        ];
    }

    /**
     * @return string
     */
    protected function send_unknown_error() {
        return 'Transaction has been failed';
    }

    /**
     * @return array
     */
    protected function verify_errors() {
        return [
            "-1" => 'Api is required',
            "-2" => 'transId is required',
            "-3" => 'No payment gateway found for your Api or the payment gateway is disabled',
            "-4" => 'Merchant is disabled',
            "-5" => 'Transaction has been failed',
        ];
    }

    /**
     * @return string
     */
    protected function verify_unknown_error() {
        return 'Transaction has been failed';
    }
}