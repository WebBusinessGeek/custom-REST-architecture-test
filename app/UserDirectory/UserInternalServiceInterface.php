<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:47 AM
 */

namespace App\UserDirectory;


interface UserInternalServiceInterface {


    public function store($credentialsOrAttributes =[]);

    public function show($model_id);

    public function update($model_id, $attributes = array());

    public function destroy($model_id);


}