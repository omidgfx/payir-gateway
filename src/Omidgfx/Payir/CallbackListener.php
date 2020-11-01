<?php namespace Omidgfx\Payir;

use Exception;
use Omidgfx\Payir;

class CallbackListener
{
    /** @var Payir */
    private $payir;

    /** @var string */
    private $token;

    /** @var callable */
    private $onSuccess;

    /** @var callable */
    private $onError;

    /** @var callable */
    private $onException;

    /**
     * CallbackListener constructor.
     * @param Payir $payir
     */
    public function __construct(Payir $payir) {
        $this->onError =
        $this->onSuccess =
        $this->onException = static function () { };
        $this->payir   = $payir;
    }

    /**
     * @return Payir
     */
    public function getPayir() {
        return $this->payir;
    }

    #region setters & getters

    /**
     * @param callable $onSuccess
     * Parameters:
     * <ul><li>Omidgfx\Payir\VerifyResponse $verifyResponse</li></ul>
     * Example: <pre>setOnSuccess(function(Omidgfx\Payir\VerifyResponse $verifyResponse){
     *  YOUR CODE...
     *});</pre>
     * @return CallbackListener
     */
    public function setOnSuccess($onSuccess) {
        $this->onSuccess = $onSuccess;
        return $this;
    }

    /**
     * @param callable $onError
     * Parameters:
     * <ul><li>Omidgfx\Payir\ErrorResponse $errorResponse</li></ul>
     * Example: <pre>setOnError(function(Omidgfx\Payir\ErrorResponse $errorResponse){
     *  echo $errorResponse->currentVerifyError();
     *});</pre>
     * @return CallbackListener
     */
    public function setOnError($onError) {
        $this->onError = $onError;
        return $this;
    }

    /**
     * @param callable $onException
     * Parameters:
     * <ul><li>Omidgfx\Payir\PayirException | \Exception $exception</li></ul>
     * Example: <pre>setOnException(function(\Exception $exception){
     *  throw $exception;
     *});</pre>
     * @return CallbackListener
     */
    public function setOnException($onException) {
        $this->onException = $onException;
        return $this;
    }

    /**
     * @param string $token
     */
    public function setToken($token) {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

    #endregion

    public function listen() {
        if (!$this->token) {
            $this->token = !empty($_GET['token']) ? $_GET['token'] : null;
        }

        if (!$this->token) {
            $fn = $this->{'onException'};
            $fn(new PayirException('Invalid or empty token.'));
        }
        try {
            $result = $this->payir->verify($this->token);
            $fn     = $this->{$result instanceof VerifyResponse
                ? 'onSuccess'
                : 'onError'
            };
            $fn($result);
        } catch (Exception $exception) {
            $fn = $this->{'onException'};
            $fn($exception);
        }


    }
}