<?php namespace Omidgfx\Payir\Languages;

use Omidgfx\Payir\Language;

class fa extends Language
{

    /**
     * @return array
     */
    protected function send_errors() {
        return [
            "-1"     => 'ارسال api الزامی می باشد',
            "-2"     => 'ارسال مبلغ الزامی می باشد',
            "-3"     => 'مبلغ باید به صورت عددی باشد',
            "-4"     => 'مبلغ نباید کمتر از 1000 باشد',
            "-5"     => 'ارسال آدرس بازگشتی الزامی می باشد',
            "-6"     => 'درگاه پرداختی با api ارسالی یافت نشد و یا غیر فعال می باشد',
            "-7"     => 'فروشنده غیر فعال می باشد',
            "-8"     => 'آدرس بازگشتی با آدرس درگاه پرداخت ثبت شده همخوانی ندارد',
            "-12"    => 'طول فیلد description بیشتر از 255 کاراکتر می باشد',
            "failed" => 'تراکنش با خطا مواجه شد',
        ];
    }

    /**
     * @return string
     */
    protected function send_unknown_error() {
        return 'تراکنش با خطا مواجه شد';
    }

    /**
     * @return array
     */
    protected function verify_errors() {
        return [
            "-1" => 'ارسال api الزامی می باشد',
            "-2" => 'ارسال transId الزامی می باشد',
            "-3" => 'درگاه پرداختی با api ارسالی یافت نشد و یا غیر فعال می باشد',
            "-4" => 'فروشنده غیر فعال می باشد',
            "-5" => 'تراکنش با خطا مواجه شده است',
        ];
    }

    /**
     * @return string
     */
    protected function verify_unknown_error() {
        return 'تراکنش با خطا مواجه شد';
    }
}