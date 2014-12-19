<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:49 AM
 */

namespace App\Polymorphic;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait RepositoryTrait {

    /**
     * Stores Eloquent models in their respective database table and returns the stored instance.
     * @param Model $model
     * @return Model
     */
    public function storeEloquentModelInDatabase(Model $model)
    {
        $model->save();
        return $model;
    }



    /**
     * Returns model specified, otherwise throws an error. Will cause FATAL ERROR if class name cannot be found.
     * @param $model_id
     * @param $className
     * @return string
     */
    public function getEloquentModelFromDatabase($model_id, $className)
    {
        try
        {
            return $className::findOrFail($model_id);
        }
        catch(ModelNotFoundException $e)
        {
            return 'Model not found.';
        }
    }


    /**
     * Deletes Model passed in. Returns true if Model was deleted.
     * @param Model $model
     * @param $className
     * @return mixed
     */
    public function deleteEloquentModelFromDatabase(Model $model, $className)
    {
        return ($className::destroy($model->id))? true :false;
    }






}