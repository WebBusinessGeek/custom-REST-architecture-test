<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 1:21 PM
 */

namespace App\Auth;


use App\Base\InternalService;
use App\Polymorphic\AuthenticationTrait;
use App\UserDirectory\User;

class AuthInternalService extends InternalService {

    use AuthenticationTrait;

    public function __construct()
    {
        $this->model = new Auth();
    }


    public function index()
    {
        // TODO: Implement index() method.
    }

    /**
     * Stores a new auth session Model if credentials passed are valid, otherwise returns error message.
     * @param array $credentialsOrAttributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function store($credentialsOrAttributes = [])
    {
        $userNameSpace = new User();
        $userClassName  = $userNameSpace->getClassName();

        $key = $this->getSpecificModelAttributeWithSetting('key', $userClassName);

        $identifier = $this->getSpecificModelAttributeWithSetting('identifier', $userClassName);

        $potentialUser = $this->confirmLoginCredentials($credentialsOrAttributes[$key],
            $credentialsOrAttributes[$identifier],
            $key, $identifier, $userClassName);

        if ($this->isSpecificModelInstance($potentialUser, $userClassName))
        {
            $token = $this->createPublicToken();
            $userId = $potentialUser->id;
            $ipAddress = $credentialsOrAttributes['ipAddress'];
            $hashSecret = $this->createSecretHash($this->getModelDelimiter(), $token, $userId, $ipAddress);
            $expDate = $this->createLoginExpirationDate($this->getModelLoginExpiration());

            $attr = [
                'publicToken' => $token,
                'userId' => $userId,
                'ipAddress' => $ipAddress,
                'hashSecret' => $hashSecret,
                'expiresOn' => $expDate
            ];

            return $this->storeEloquentModelInDatabase($this->addAttributesToNewModel($attr, $this->getModelClassName()));
        }
        return $this->sendMessage('Invalid credentials.');
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