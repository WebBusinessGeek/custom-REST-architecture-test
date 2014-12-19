<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 1:22 PM
 */

namespace App\Auth;


interface AuthInternalServiceInterface {

    public function store($credentialsOrAttributes = []);

    public function show($model_id);

    public function destroy($model_id);

}