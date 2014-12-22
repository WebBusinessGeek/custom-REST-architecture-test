<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:47 AM
 */

namespace App\UserDirectory;


use App\Base\ExternalService;
use Illuminate\Foundation\Application;


class UserExternalService extends ExternalService {

    protected $serviceSubject = 'User';



    public function __construct()
    {
        $this->internalService = Application::getInstance()->make('\App\UserDirectory\UserInternalServiceInterface');
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * Creates, stores, and returns a new User instance if attributes are correct, otherwise returns an error message.
     * Responses are in Json format. 
     * @param array $credentialsOrAttributes
     * @return string
     */
    public function store($credentialsOrAttributes = [])
    {
        $apiResponse = $this->internalService->store($credentialsOrAttributes);

        if(is_object($apiResponse) && '\\'. get_class($apiResponse) == $this->getInternalServiceModelClassName())
        {
            return $this->sendMessageInJson($this->serviceSubject, $apiResponse, $this->successCreationCode);
        }
        return $this->sendMessageInJson($this->errorSubject, $apiResponse, $this->errorCreationCode);
    }

    public function show($data)
    {
        //get client info

        //check if user is logged in
        //check if user is authorized

        // - if so return show method
          // - check if error message returned
            // - if so return the error message in Json
            // - if not return the data requested

        // - if not return error message in json
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}