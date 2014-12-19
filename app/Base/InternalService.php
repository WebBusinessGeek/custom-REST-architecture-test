<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:46 AM
 */

namespace App\Base;



use App\Polymorphic\RepositoryTrait;
use App\Polymorphic\ResponderTrait;
use App\Polymorphic\ValidatorTrait;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

abstract class InternalService {

    use ValidatorTrait, ResponderTrait,  RepositoryTrait;

    public $model;

    abstract public function index();

    abstract public function store($credentialsOrAttributes =[]);

    abstract public function show($model_id);

    abstract public function update($model_id, $attributes = array());

    abstract public function destroy($model_id);

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


    /**
     * Returns true if all values and attributes are valid, otherwise false.
     * No tests for function directly!
     * @param array $attributes
     * @return bool
     */
    public function checkAttributes($attributes = array())
    {
       return (
        $this->modelAcceptsAttributes($attributes, $this->getModelAttributes()) &&
        $this->modelNonNullableAttributesSet($attributes, $this->getModelAttributes()) &&
        $this->checkMajorFormatsAreValid($attributes, $this->getModelAttributes()) &&
        $this->avoidDuplicationOfUniqueData($attributes, $this->getModelAttributes(), $this->getModelClassName())
       == true ) ? :false;

    }

    /**
     * Returns true if passed in Model instance is an actual instance, otherwise false.
     * @param $potentialModel
     * @return bool
     */
    public function isModelInstance($potentialModel)
    {
        return (is_object($potentialModel) && '\\'. get_class($potentialModel) == $this->getModelClassName());
    }

    public function isSpecificModelInstance($potentialModel, $modelClassName)
    {
        return (is_object($potentialModel) && '\\'. get_class($potentialModel) == $modelClassName);

    }


    public function getModelAttributeWithSetting($settingName)
    {
        return $this->model->getAttributeWithSetting($settingName);
    }

    public function getSpecificModelAttributeWithSetting($settingName, $modelClassName)
    {
        $model = $this->createNewModel($modelClassName);
        return $model->getAttributeWithSetting($settingName);
    }


    public function getModelDelimiter()
    {
        return $this->model->getDelimiter();
    }


    public function getModelLoginExpiration()
    {
        return $this->model->getLoginExpiration();
    }





}