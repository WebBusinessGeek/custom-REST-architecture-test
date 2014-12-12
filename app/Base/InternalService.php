<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/12/14
 * Time: 10:46 AM
 */

namespace App\Base;


use App\Polymorphic\FactoryTrait;
use App\Polymorphic\InvokerTrait;
use App\Polymorphic\RepositoryTrait;
use App\Polymorphic\ResponderTrait;
use App\Polymorphic\ValidatorTrait;

abstract class InternalService {

    use ValidatorTrait, ResponderTrait, FactoryTrait, RepositoryTrait, InvokerTrait;

    public $model;

    abstract public function index();

    abstract public function store();

    abstract public function show();

    abstract public function update();

    abstract public function destroy();

}