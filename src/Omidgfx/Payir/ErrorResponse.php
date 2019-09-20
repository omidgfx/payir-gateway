<?php namespace Omidgfx\Payir;

/**
 * Class ErrorResponse
 *
 * @property-read int|string errorCode
 * @property-read string errorMessage
 * @package Omidgfx\Payir
 */
class ErrorResponse extends Response
{
    private $__uri;

    public function __construct($data, $payirInstance, $uri) {
        parent::__construct($data, $payirInstance);
        $this->__uri = $uri;
    }

    /**
     * @return string
     */
    public function error() {
        $payir    = $this->getPayirInstance();
        $language = $payir->getLanguage();
        return $language->translate($this->errorCode, $this->__uri);
    }

    /**
     * @return string[]
     */
    public function responseFieldsToCheck() {
        return ['status', 'errorCode', 'errorMessage'];
    }
}