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
                //existsIsValid method - not done
                //ipAddressIsValid method- not done
                //tokenIsValid method- not done
                //dateIsValid method- not done
                //timeIsValid method- not done
                //dateTimeIsValid method- not done
            //avoid duplication of unique data

        //check if credentials correct - store response (should receive a user if it is) - not done

        //if correct
            // create auth token using attribute values and push it to attributes ALONG WITH USER ID!!
            // add attributes to new model - done
            // store model - done
            // return model
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