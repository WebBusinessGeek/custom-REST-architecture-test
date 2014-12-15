<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:49 AM
 */

namespace App\Polymorphic;


use Illuminate\Database\Eloquent\Model;

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


}