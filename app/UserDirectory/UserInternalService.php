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

    public function store($credentialsOrAttributes =[], $owner_id = null, $ownerType = null)
    {
        //take associative array

        //checks before placing values
            //must check if model accepts the keys - DONE
            //must check that all non Nullable values were sent - DONE
            //must check if they are in a valid format - DONE
                // password - done
                // email - done
            //must check if all mandatory unique values are unique - DONE


        //if all good
            //place values on model by its keys - DONE
            //save to database - not done
            //return the instance? - not done

        //if issues
            //return error message - NOT Done

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