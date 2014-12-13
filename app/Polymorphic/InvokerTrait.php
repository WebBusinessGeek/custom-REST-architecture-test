<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:50 AM
 */

namespace App\Polymorphic;


use Symfony\Component\Process\Exception\InvalidArgumentException;

trait InvokerTrait {


    /**
     * Returns a named array of the specified configuration values. Otherwise throws an exception.
     * @param $modelAttributes
     * @param $config
     * @return array
     */
    public function getModelAttributeConfiguration($modelAttributes, $config)
    {
        $configKeys = [
            'name', 'nullable', 'format', 'unique', 'enumValues'
        ];

        if(in_array($config, $configKeys) == true)
        {
            $configArray = [];
            foreach($modelAttributes as $attribute)
            {
                array_push($configArray, $attribute[$config]);
            }

            $completeConfigArray = array_combine($this->getModelAttributeNames($modelAttributes),$configArray);
            return $completeConfigArray;
        }
        throw new InvalidArgumentException('Configuration values invalid');
    }


    /**
     * Returns all the names of the attributes
     * @param $modelAttributes
     * @return array
     */
    public function getModelAttributeNames($modelAttributes)
    {
            $configNameArray = [];
            foreach($modelAttributes as $attribute)
            {
                array_push($configNameArray, $attribute['name']);
            }
            return $configNameArray;
    }

}