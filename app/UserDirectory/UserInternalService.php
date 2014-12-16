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
     * @param null $owner_id
     * @param null $ownerType
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function store($credentialsOrAttributes =[])
    {
        return
            (
                $this->modelAcceptsAttributes($credentialsOrAttributes, $this->getModelAttributes()) &&
                $this->modelNonNullableAttributesSet($credentialsOrAttributes, $this->getModelAttributes()) &&
                $this->checkAllFormatsAreValid($credentialsOrAttributes, $this->getModelAttributes()) &&
                $this->avoidDuplicationOfUniqueData($credentialsOrAttributes, $this->getModelAttributes(), $this->getModelClassName())
            )
                ?  $this->storeEloquentModelInDatabase($this->addAttributesToModel($credentialsOrAttributes, $this->getModelClassName()))
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



    public function update()
    {
        //call show method

        //check if instance or error message

            // if instance
                //update logic
                //return instance

            // if error message
                //return error message
    }

    public function destroy()
    {

    }


}