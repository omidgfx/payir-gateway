<?php namespace Omidgfx\Payir;


/**
 * Class VerifyResponse
 *
 * @property-read int $amount
 * @property-read mixed $transId
 * @property-read mixed $factorNumber
 * @property-read string $mobile
 * @property-read string $description
 * @property-read string $cardNumber
 * @property-read string $message
 * @package Omidgfx\Payir
 */
class VerifyResponse extends SuccessResponse
{
    /**
     * @return string[]
     */
    public function responseFieldsToCheck() {
        return ['status', 'amount', 'transId', 'factorNumber', 'mobile', 'description', 'cardNumber', 'message'];
    }

}