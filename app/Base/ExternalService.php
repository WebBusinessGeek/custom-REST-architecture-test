<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:46 AM
 */

namespace App\Base;


use App\Polymorphic\AuthenticationTrait;
use App\Polymorphic\AuthorizationTrait;
use App\Polymorphic\ResponderTrait;


abstract class ExternalService {

    use ResponderTrait, AuthenticationTrait, AuthorizationTrait;

    protected $model;

    protected $internalService;

    abstract public function index();

    abstract public function store();

    abstract public function show();

    abstract public function update();

    abstract public function destroy();
}