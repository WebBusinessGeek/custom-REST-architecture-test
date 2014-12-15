<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:49 AM
 */

namespace App\Polymorphic;


trait FactoryTrait {


    /**
     * Returns a new instance of the class name passed in.
     * PHP will throw FATAL ERROR if the class name does not exist.
     * @param $className
     */
    public function createNewModel($className)
    {
      return  $instance = new $className;
    }

}