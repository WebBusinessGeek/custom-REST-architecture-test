<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:48 AM
 */

namespace App\Polymorphic;


trait ValidatorTrait {


    /**
     * Returns true if arrayToCheck keys match the values in the model accepted attributes array, otherwise returns false.
     * @param $arrayToCheck
     * @param $modelAcceptedAttributes
     * @return bool
     */
    public function modelAcceptsAttributes($arrayToCheck, $modelAcceptedAttributes)
    {
        $responses = [];
        foreach($arrayToCheck as $key => $value)
        {
            (in_array($key, $modelAcceptedAttributes)) ? : array_push($responses, false);
        }
        return (in_array(false, $responses))? false : true;

    }

    /**
     * Returns true if all non nullable values are set in arrayToCheck argument, otherwise false.
     * @param $arrayToCheck
     * @param $modelNonNullableAttributes
     * @return bool
     */
    public function modelNonNullableAttributesSet($arrayToCheck, $modelNonNullableAttributes)
    {
        $responses = [];

        for($i = 0; $i < count($modelNonNullableAttributes); $i++)
        {
            ($arrayToCheck[$modelNonNullableAttributes[$i]] != null) ? : array_push($responses, false);
        }

        return (in_array(false, $responses))? false : true;
    }

}