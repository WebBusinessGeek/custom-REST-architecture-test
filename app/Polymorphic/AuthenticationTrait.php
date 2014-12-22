<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:50 AM
 */

namespace App\Polymorphic;


trait AuthenticationTrait {


    /**
     * Returns Eloquent model instance if login credentials are correct, otherwise false.
     * @param $keyValue
     * @param $identifierValue
     * @param $keyName
     * @param $identifierName
     * @param $className
     * @return bool or Model
     */
    public function confirmLoginCredentials($keyValue, $identifierValue, $keyName, $identifierName, $className)
    {
        $user = $className::where($identifierName, '=', $identifierValue)->first();
        return (password_verify($keyValue, $user->$keyName))? $user : false;
    }


    /**
     * Generates a public key after authenticating.
     * @return string
     */
    public function createPublicToken()
    {
        return uniqid('publicKey', true);
    }


    /**
     * Returns a secret hash of the parameters specified.
     * Delimiter is for splitting the string during the hash verify process.
     * @param $delimiter
     * @param $para1
     * @param null $para2
     * @param null $para3
     * @param null $para4
     * @return string
     */
    public function createSecretHash($delimiter, $para1, $para2 = null, $para3 = null, $para4 = null)
    {
        $passwordHashed = password_hash($para1.$para2.$para3.$para4, PASSWORD_DEFAULT);

        $tokenHashed = uniqid('secretKey_$krx2342387edw').$delimiter.$passwordHashed.$delimiter.mt_rand();

        return $tokenHashed;
    }

    /**
     * Returns true if secret passed in is valid, otherwise false.
     * @param $secret
     * @param $secretHash
     * @param $delimiter
     * @return bool
     */
    public function secretHash_verify($secret, $secretHash, $delimiter)
    {
        $explodedHash = explode($delimiter, $secretHash);
        return password_verify($secret, $explodedHash[1]);
    }


    /**
     * Returns a DateTime object equal to $expireRate hours more than the current time.
     * @param $expireRate
     * @return \DateTime
     */
    public function createLoginExpirationDate($expireRate)
    {
        return new \DateTime("+{$expireRate} hours");
    }



    /**
     * Returns an array of attributes hashed where specified.
     * @param array $credentialsOrAttributes
     * @param array $hashAbleAttributes
     * @return array
     */
    public function hashHashAbleAttributes($credentialsOrAttributes = [], $hashAbleAttributes = [])
    {
        foreach($credentialsOrAttributes as $key => $value)
        {
            if(in_array($key, $hashAbleAttributes))
            {
                $credentialsOrAttributes[$key] = password_hash($value, PASSWORD_DEFAULT);
            }
        }
        return $credentialsOrAttributes;
    }
}