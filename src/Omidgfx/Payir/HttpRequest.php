<?php namespace Omidgfx\Payir;

abstract class HttpRequest
{
    /**
     * @param string $url
     * @param array|object $parameters
     * @return array
     */
    public static function post($url, $parameters) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response         = curl_exec($curl);
        $response         = @json_decode($response, true);
        $http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return compact('http_status_code', 'response');
    }
}