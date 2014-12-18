<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:50 AM
 */

namespace App\Polymorphic;


use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Exception\InvalidArgumentException;

trait InvokerTrait {

    use FactoryTrait;

    /**
     * Returns a named array of the specified configuration values. Otherwise throws an exception.
     * @param $modelAttributes
     * @param $config
     * @return array
     */
    public function getModelAttributeConfiguration($modelAttributes, $config)
    {
        $configKeys = [
            'name', 'nullable', 'format', 'unique', 'enumValues', 'exists', 'identifier', 'key'
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

    /**
     * Dynamically adds attributes to a new model instance.
     * @param array $attributes
     * @param $className
     * @return mixed
     */
    public function addAttributesToNewModel($attributes = array(), $className)
    {

        $model = $this->createNewModel($className);

        foreach($attributes as $key => $value)
        {
            $model->$key = $value;
        }

        return $model;
    }


    /**
     * Adds attributes to an existing Eloquent Model.
     * @param Model $model
     * @param $attributes
     * @return Model
     */
    public function addAttributesToExistingModel(Model $model, $attributes)
    {
        foreach($attributes as $key => $value)
        {
            $model->$key = $value;
        }
        return $model;
    }

}