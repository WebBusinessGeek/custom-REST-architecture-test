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



    public function index()
    {

    }

    public function store($credentialsOrAttributes =[], $owner_id = null)
    {
        //take associative array

        //checks before placing values
            //must check if model accepts the keys - DONE
            //must check that all unNullable values were sent
            //must check if they are in a valid format
            //also check if the values are unique
            //check if owner exists

        //if all good
            //place values on model by its keys

        //if issues
            //return error message

    }

    public function show()
    {
        
    }

    public function update()
    {

    }

    public function destroy()
    {

    }


}