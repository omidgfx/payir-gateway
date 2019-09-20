<?php namespace Omidgfx\Payir;


interface ResponseInterface
{
    /**
     * @return string[]
     */
    public function responseFieldsToCheck();
}