<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:46 AM
 */

namespace App\Base;


use App\Polymorphic\FactoryTrait;
use App\Polymorphic\InvokerTrait;
use App\Polymorphic\RepositoryTrait;
use App\Polymorphic\ResponderTrait;
use App\Polymorphic\ValidatorTrait;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

abstract class InternalService {

    use ValidatorTrait, ResponderTrait,  RepositoryTrait;

    public $model;

    abstract public function index();

    abstract public function store($credentialsOrAttributes =[], $owner_id = null, $ownerType = null);

    abstract public function show();

    abstract public function update();

    abstract public function destroy();

    /**
     *Ensures requirements are set on services and their models.
     */
    public function __construct()
    {
        if($this->model == null || $this->model->modelAttributes = null)
        {
            throw new MissingMandatoryParametersException('No model on class or no attributes on model');
        }
    }


    /**
     * Returns $model's attributes as a multidimensional array.
     * @return mixed
     */
    public function getModelAttributes()
    {
        return $this->model->getAttributes();
    }


    /**
     * Return $model's class name.
     * @return mixed
     */
    public function getModelClassName()
    {
        return $this->model->getClassName();
    }

}