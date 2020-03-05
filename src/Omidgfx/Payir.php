<?php namespace Omidgfx;

use Omidgfx\Payir\CallbackListener;
use Omidgfx\Payir\ErrorResponse;
use Omidgfx\Payir\HttpRequest;
use Omidgfx\Payir\Language;
use Omidgfx\Payir\PayirException;
use Omidgfx\Payir\SendResponse;
use Omidgfx\Payir\SuccessResponse;
use Omidgfx\Payir\VerifyResponse;

class Payir extends HttpRequest
{
    const LANGUAGE_FARSI   = 'fa';
    const LANGUAGE_ENGLISH = 'en';

    private static $baseUrl = 'https://pay.ir/pg/';

    /** @var string */
    private $api;

    /** @var Language */
    private $language = null;

    /**
     * @return Language
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Payir constructor.
     * @param string $api
     * @param string $language Error message language.
     */
    public function __construct($api, $language = self::LANGUAGE_FARSI) {
        $this->api      = $api;
        $language       = $language == 'fa' ? 'fa' : 'en';
        $language       = "Omidgfx\\Payir\\Languages\\$language";
        $this->language = new $language;
    }

    /**
     * @param int $amount Amount in Rials >= 1000
     * @param string $redirect The return address to your website, in the form of urlencode, which must be on the same domain as the verified payment gateway address on Pay.ir
     * @param string $mobile Buyer mobile number to show the buyer cards on gateway and display the mobile gateway to pay
     * @param null $factorNumber Your invoice number
     * @param null $description Descriptions 255 Chars maximum, utf-8 support
     * @param null $validCardNumber The credit card number allowed for the transaction. 16 digit english without any seperators.
     * @return ErrorResponse|SendResponse
     * @throws PayirException
     */
    public function send($amount, $redirect, $mobile = null, $factorNumber = null, $description = null, $validCardNumber = null) {
        $parameters = compact('amount', 'redirect', 'mobile', 'factorNumber', 'description', 'validCardNumber');
        $parameters = array_merge($parameters, ['resellerId' => '1000001030']);
        return $this->request('send', $parameters, SendResponse::class);
    }

    /**
     * @param string $token
     * @return ErrorResponse|VerifyResponse
     * @throws PayirException
     */
    public function verify($token) {
        return $this->request('verify', compact('token'), VerifyResponse::class);
    }

    /**
     * @return CallbackListener
     */
    public function makeCallbackListener() {
        return new CallbackListener($this);
    }

    /**
     * @return string
     */
    public static function getBaseUrl() {
        return self::$baseUrl;
    }


    /**
     * @param string $uri 'send' or 'verify'
     * @param array $parameters
     * @param string $successClassName
     * @return ErrorResponse|SuccessResponse
     * @throws PayirException
     */
    private function request($uri, $parameters, $successClassName) {
        $parameters = array_merge(['api' => $this->api], $parameters);
        $response   = @self::post(self::getBaseUrl() . $uri, $parameters);

        if (!$response || $response === false)
            throw new PayirException('Invalid response.');

        $httpCode = $response['http_status_code'];
        $response = $response['response'];

        if ($httpCode == 200 && (isset($response['status']) && $response['status'] == 1))
            return new $successClassName($response, $this);

        if ($httpCode == 422 || (isset($response['status']) && $response['status'] == 0))
            return new ErrorResponse($response, $this, $uri);

        throw new PayirException('Invalid response data.');

    }
}
