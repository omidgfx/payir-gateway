<?php namespace Omidgfx\Payir;

abstract class Language
{
    /**
     * @return array
     */
    abstract protected function send_errors();

    /**
     * @return string
     */
    abstract protected function send_unknown_error();

    /**
     * @return array
     */
    abstract protected function verify_errors();

    /**
     * @return string
     */
    abstract protected function verify_unknown_error();

    /**
     * @param $code
     * @param $uri
     * @return mixed
     */
    public function translate($code, $uri) {
        $uri    = $uri === 'send' ? 'send' : 'verify';
        $errors = $this->{$uri . '_errors'}();

        if (key_exists($code, $errors))
            return $errors[$code];

        return $this->{$uri . '_unknown_error'};
    }
}