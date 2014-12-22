<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 1:22 PM
 */

namespace App\Auth;


use App\Base\ExternalService;
use Illuminate\Foundation\Application;

class AuthExternalService extends ExternalService{

    public function __construct()
    {
        $this->internalService = Application::getInstance()->make('\App\Auth\AuthInternalServiceInterface');
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function store()
    {
//        return $this->internalService->store();
    }

    public function show()
    {
        // TODO: Implement show() method.
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