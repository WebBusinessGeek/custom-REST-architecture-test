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

    public function store($credentialsOrAttributes = [])
    {
        if ($this->modelAcceptsAttributes($credentialsOrAttributes, $this->getModelAttributes())&&
            $this->modelNonNullableAttributesSet($credentialsOrAttributes, $this->getModelAttributes())&&
            $this->checkMajorFormatsAreValid($credentialsOrAttributes, $this->getModelAttributes())&&
            $this->existsIsValid($credentialsOrAttributes, $this->getModelAttributes())&&
            $this->avoidDuplicationOfUniqueData($credentialsOrAttributes, $credentialsOrAttributes, $this->getModelClassName()))
        {
            //check and store user if credentials correct - done
            $key = $this->getModelAttributeWithSetting('key');
            $identifier = $this->getModelAttributeWithSetting('identifier');
            $potentialUser = $this->confirmLoginCredentials($credentialsOrAttributes[$key],
                $credentialsOrAttributes[$identifier],
                $key, $identifier, $this->getModelClassName());

            //if correct
            // create public token - done
            // create expiration date - done
            // make hashSecret with (user_id, token, ipAddress) - done
            // add all attributes to new model - done
            // store model - done
            // return model - done

            if ($this->isModelInstance($potentialUser))
            {
                $token = $this->createPublicToken();
                $userId = $potentialUser->id;
                $ipAddress = $credentialsOrAttributes['ipAddress'];
                $hashSecret = $this->createSecretHash($this->getModelDelimiter(), $token, $userId, $ipAddress);
                $expDate = $this->createLoginExpirationDate($this->getModelLoginExpiration());

                $attr = [
                    'token' => $token,
                    'userId' => $userId,
                    'ipAddress' => $ipAddress,
                    'hashSecret' => $hashSecret,
                    'expiresOn' => $expDate
                ];

                return $this->storeEloquentModelInDatabase($this->addAttributesToNewModel($attr, $this->getModelClassName()));
            }

            //if incorrect
            // return error message - done
//            return $this->sendMessage('Invalid credentials.');

        }
        return $this->sendMessage('Invalid Credentials');
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