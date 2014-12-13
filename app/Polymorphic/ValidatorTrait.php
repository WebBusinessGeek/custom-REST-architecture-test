<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:48 AM
 */

namespace App\Polymorphic;


trait ValidatorTrait {

    use InvokerTrait, RepositoryTrait;

    /**
     * Returns true if array passed in contains keys the model will accept as attributes.
     * @param $arrayToCheck
     * @param $modelAttributes
     * @return bool
     */
    public function modelAcceptsAttributes($arrayToCheck, $modelAttributes)
    {
        $falseCounter = 0;

        $attrArray = $this->getModelAttributeNames($modelAttributes);

        foreach($arrayToCheck as $key => $value)
        {
            (in_array($key, $attrArray)) ? : $falseCounter++;
        }

        return($falseCounter > 0) ? false : true;
    }


    /**
     * Returns true if mandatory values are set in arrayToCheck, otherwise false.
     * @param $arrayToCheck
     * @param $modelAttributes
     * @return bool
     */
    public function modelNonNullableAttributesSet($arrayToCheck, $modelAttributes)
    {
        $falseCounter = 0;
        $nullCheck =  $this->getModelAttributeConfiguration($modelAttributes, 'nullable');

        foreach($arrayToCheck as $key => $value)
        {
            if(isset($nullCheck[$key]) && $nullCheck[$key] == false)
            {
                ($value != null) ? : $falseCounter++;
            }
        }
        return ($falseCounter > 0) ? false : true;
    }




}