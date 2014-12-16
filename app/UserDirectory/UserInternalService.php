<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:47 AM
 */

namespace App\UserDirectory;


use App\Base\InternalService;

class UserInternalService extends InternalService {


    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {

    }

    /**
     * Stores a User model into its database table if attributes passed are valid.
     * Otherwise will throw an error message.
     * @param array $credentialsOrAttributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function store($credentialsOrAttributes =[])
    {
        return ($this->checkAttributes($credentialsOrAttributes))
                ?  $this->storeEloquentModelInDatabase($this->addAttributesToNewModel($credentialsOrAttributes, $this->getModelClassName()))
                :  $this->sendMessage('Error. Invalid attributes or duplicate data.');
    }

    /**
     * Return specified User from users database table.
     * @param $model_id
     * @return string
     */
    public function show($model_id)
    {
       return $this->getEloquentModelFromDatabase($model_id, $this->getModelClassName());
    }


    /**
     * Updates a User instance if attributes are valid, and instance exists.
     * Otherwise returns an error message.
     * @param $model_id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed|string
     */
    public function update($model_id, $attributes = array())
    {
        $potentialModel = $this->show($model_id);

        if(is_object($potentialModel) && '\\'. get_class($potentialModel) == $this->getModelClassName())
        {
            return ($this->checkAttributes($attributes))
                ? $this->storeEloquentModelInDatabase($this->addAttributesToExistingModel($potentialModel, $attributes))
                : $this->sendMessage('Error. Invalid attributes or duplicate data.');
        }
        return $potentialModel;
    }



    public function destroy()
    {

    }


}