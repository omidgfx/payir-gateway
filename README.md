# Pay.ir gateway for composer
##### Makes your (pay.ir) payments easy and implements reliable interfaces for payment gateway.

---
Payir Gateway is a composer library to help working with pay.ir payment gateway.

* Secure
* Reliable
* Easy-to-use

## Tutorial
#### [▷ Watch tutorial video in aparat](https://www.aparat.com/v/vBHIQ)


## Basic scenario

 For a healthy payment, first of all you need to send the order information to pay.ir and get a token and store it in your database (uniquely), then pass your client to an address that's involved with the token you just got. The client pays and passes back to your website again.

 Now the client is in your website, you should verify his payment and sell your stuff.

---

### How to use?

* #### Step 1
   Add [Payir Gateway](https://packagist.org/packages/omidgfx/payir-gateway) to your project.

   ```shell
   $ composer require omidgfx/payir-gateway
   ```
   
* #### Step 2
   Create an instance of `Omidgfx\Payir` class using by your `API-KEY`.

   ```php
    $payir = new Omidgfx\Payir(
        # api key
           'API-KEY-STRING',
        # language
           Payir::LANGUAGE_FARSI // or Payir::LANGUAGE_ENGLISH
    );
   ```
   
* #### Step 3
   Get a new `token` from pay.ir by `send` method and use it for opening payment gateway.
    ```php
    $response = $payir->send(
        # total amount of the order
            1000,
        # callback url to your website
            'https://myshop.com/verify?order=123',
        # mobile number [optional]
            '09121111111',
        # factor number
            '123',
        # description of the order
            'Some description',
        # valid card number
            '6219861012345678'
    );
    ```
      > Use `try-catch` to catch the exceptions.

* #### Step 4
    Check for `$response` to be an instance of `Omidgfx\Payir\SendResponse` class.

    * if `$response` was an instance of `Omidgfx\Payir\SendResponse` class then save the token in your database and then redirect your client to **Pay Link** by `$response->redirectToPayLink()` or get **Pay Link** by`$response->getPayLink()` as a string.
    * if `$response` was an instance of `Omidgfx\Payir\ErrorResponse` class then show the error message to your client by `$response->error()` or track it down to fix it.<br><br>
    
    ```php
   if ($response instanceof Omidgfx\Payir\SendResponse) {
       $response->redirectToPayLink(); # redirection
   } elseif ($response instanceof Omidgfx\Payir\ErrorResponse) {
       echo 'ERR ' . $response->errorCode . ': ' . $response->error();
   }
    ``` 
   
* #### Step 5
    After payment action performed, the client will be passed to your website, now you need to verify the transaction. Payir Gateway will do this for you with a cool callback listener like following:
    > Imagine `https://site.com/verify.php?invoice=123` is your callback (redirect), following code must written in your callback listener controller for example `verify.php`. 
    
   Do [Step 2](#step-2) in `verify.php` again.
   ```php
  $payir = new Omidgfx\Payir(
       # api key
          'API-KEY-STRING',
       # language
          Payir::LANGUAGE_FARSI // or Payir::LANGUAGE_ENGLISH
   );
   ```
    Create your callback listener:
    ```php
  $cb = $payir->makeCallbackListener();
    ```    
    Setup events on your callback listener:
    * setOnError
    * setOnSuccess
    * setOnException
    
    ```php
  $cb->setOnError(function (Payir\ErrorResponse $errorResponse) {
     echo 'ERR ' . $errorResponse->errorCode . ': ' . $errorResponse->error();
   })->setOnSuccess(function (Payir\VerifyResponse $verifyResponse) {
     // $verifyResponse->status is always 1 here
     /*
     // Save these data or use them to check if transId is in your database already.
     $status       = $verifyResponse->status;
     $amount       = $verifyResponse->amount;
     $transId      = $verifyResponse->transId;
     $factorNumber = $verifyResponse->factorNumber;
     $mobile       = $verifyResponse->mobile;
     $factorNumber = $verifyResponse->factorNumber;
     $description  = $verifyResponse->description;
     $message      = $verifyResponse->message;
     */
      if(DB::getInstance()->exists('orders', ['trans_id' => $verifyResponse->transId]) == false){
          // SELL YOUR STUFF HERE
      }else{
          echo 'ERR: Security reason';
      }
   })->setOnException(function (Exception $exception) {
     //throw $exception;
     echo 'ERR: ' . $exception->getMessage();
   });
    ```
  Now turn on your callback listener like following:
  ```php
  $cb->listen();
  ```
---
Created with ❤ by [Pejman Chatrrouz (Omidgfx)](https://github.com/omidgfx)

### 🎁 [Donate me](https://me.pay.ir/omidgfx)

[Email](mailto:info@omidgfx.com) | [Facebook](https://fb.com/omidgfx)
