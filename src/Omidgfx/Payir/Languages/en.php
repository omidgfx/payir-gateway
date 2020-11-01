<?php namespace Omidgfx\Payir\Languages;

use Omidgfx\Payir\Language;

class en extends Language
{

    /**
     * @return array
     */
    protected function send_errors() {
        return [
            '0'      => 'Currently, the bank gateway is down. The problem will be fixed soon',
            '-1'     => 'API Key is required',
            '-2'     => 'Token is required',
            '-3'     => 'Incorrect API Key',
            '-4'     => 'The merchant is not allwoed for this transaction',
            '-5'     => 'There is a problem in transaction',
            '-6'     => 'The transaction is duplicate or previously performed',
            '-7'     => 'Invalid Token',
            '-8'     => 'Invalid Transaction ID',
            '-9'     => 'Transaction timeout',
            '-10'    => 'Amount is required',
            '-11'    => 'The transaction amount must be numeric and in Latin characters',
            '-12'    => 'The transaction amount must be between 10,000 and 500,000,000 Rials',
            '-13'    => 'The redirect url is required',
            '-14'    => 'The redirect url is not the same as the website address registered in the Pay.ir',
            '-15'    => 'Verification is not possible. This transaction has not been paid',
            '-16'    => 'One or more mobile numbers of the recipient information sent are incorrect',
            '-17'    => 'The amount of the submitted contribution should be numerical and between 1 and 100',
            '-18'    => 'The merchant format is incorrect',
            '-19'    => 'Each merchant can only have one share',
            '-20'    => 'The total share of merchants must be 100%',
            '-21'    => 'Invalid Reseller ID',
            '-22'    => 'The format or length of the values is invalid or incorrect',
            '-23'    => 'The PSP (Bank Gateway) switch is unable to process the request. Please try again later',
            '-24'    => 'The card number must be 16 digits, Latin and without any separator',
            '-25'    => 'It is not possible to use the service in your country of origin',
            '-26'    => 'It is not possible to make a transaction for this gateway',
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
        return $this->send_errors();
    }

    /**
     * @return string
     */
    protected function verify_unknown_error() {
        return 'Transaction has been failed';
    }
}