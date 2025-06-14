<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidateRequests{

    /**
     * Validate request data with the provided rules.
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array
     * @throws ValidationException
     */

    protected function validtateData(array $data, array $rules, array $messages = [], array $customAttributes = []){
        
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if($validator->fails()) throw new ValidationException($validator);

        return $validator->validated();
    }
}