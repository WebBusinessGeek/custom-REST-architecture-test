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

    public function __construct()
    {
        $this->internalService = Application::getInstance()->make('\App\UserDirectory\UserInternalServiceInterface');
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store($credentialsOrAttributes = [])
    {
        return $this->internalService->store($credentialsOrAttributes);
    }

    public function show()
    {
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