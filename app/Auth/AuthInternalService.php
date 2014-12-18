<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 1:21 PM
 */

namespace App\Auth;


use App\Base\InternalService;

class AuthInternalService extends InternalService {

    public function __construct()
    {
        $this->model = new Auth();
    }


    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($credentialsOrAttributes = [])
    {
        //run following checks on attributes
            //model accepts attributes - done
            //model non nullable attributes set - done
            //check formats are valid
                //existsIsValid method - done
            //avoid duplication of unique data - done

        //check and store user if credentials correct - done

        //if correct
            // create public token - not Done
            // create expiration date - not Done
            // make hashSecret with (user_id, token, ipAddress) - not Done
            // add all attributes to new model - done
            // store model - done
            // return model - done
        //if incorrect
            // return error message - done


    }

    public function show($model_id)
    {
        // TODO: Implement show() method.
    }

    public function update($model_id, $attributes = array())
    {
        // TODO: Implement update() method.
    }

    public function destroy($model_id)
    {
        // TODO: Implement destroy() method.
    }


}