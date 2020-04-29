<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

abstract class JsonRequest extends FormRequest
{
    var $msg;

    public static function createDeveloperMessageStatic($strings)
    {
        $data = [];
        foreach ($strings as $item) {
            array_push($data, ["message" => $item]);
        }
        return $data;
    }

    public function createDeveloperMessage($strings)
    {
        $data = [];
        foreach ($strings as $item) {
            array_push($data, ["message" => $item]);
        }
        return $data;
    }

    /**
     * Get the validator instance for the request.
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $this->msg = [];
        $factory = $this->container->make('Illuminate\Validation\Factory');

        if (method_exists($this, 'validator')) {
            return $this->container->call([$this, 'validator'], compact('factory'));
        }
        return $factory->make(
            $this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attributes()
        );
    }

}
