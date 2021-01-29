<?php namespace Omidgfx\Payir;

use Omidgfx\Payir;

/**
 * Class Response
 * @property-read int $status
 * @package Omidgfx\Payir
 */
abstract class Response implements ResponseInterface
{

    /** @var array */
    protected $__data;
    /** @var Payir */
    private $__payirInstance;

    /**
     * Response constructor.
     * @param array $data
     * @param Payir $payirInstance
     * @throws PayirException
     */
    public function __construct($data, $payirInstance) {
        if (!$data || !is_array($data)) {
            throw new PayirException('Invalid response structure');
        }
        $this->__data          = $data;
        $this->__payirInstance = $payirInstance;
        $fields                = $this->responseFieldsToCheck();
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                throw new PayirException('Invalid response structure');
            }
        }
    }

    public function __get($name) {
        return isset($this->__data[$name]) ? $this->__data[$name] : null;
    }

    public function __set($name, $value) {
        $this->__data[$name] = $value;
    }

    public function __isset($name) {
        return !array_key_exists($name, $this->__data);
    }

    /**
     * @return Payir
     */
    public function getPayirInstance() {
        return $this->__payirInstance;
    }

}