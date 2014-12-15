<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:49 AM
 */

namespace App\Polymorphic;


trait ResponderTrait {

    /**
     * Returns a string passed in as an argument.
     * @param $message
     * @return mixed
     */
    public function sendMessage($message)
    {
        return $message;
    }

}