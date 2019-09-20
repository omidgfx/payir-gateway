<?php namespace Omidgfx\Payir;

use Omidgfx\Payir;

/**
 * Class SendResponse
 *
 * @property-read string $token
 * @package Omidgfx\Payir
 */
class SendResponse extends SuccessResponse
{
    /**
     * @return string[]
     */
    public function responseFieldsToCheck() {
        return ['status', 'token'];
    }

    /**
     * @return string
     */
    public function getPayLink() {
        return Payir::getBaseUrl() . $this->token;
    }

    /**
     * @param int $http_response_code 302 by default.
     *
     * Read more in <a href="https://en.wikipedia.org/wiki/URL_redirection#HTTP_status_codes_3xx">this</a> link.
     *
     */
    public function redirectToPayLink($http_response_code = 302) {
        header("Location: " . $this->getPayLink(), true, $http_response_code);
    }

}