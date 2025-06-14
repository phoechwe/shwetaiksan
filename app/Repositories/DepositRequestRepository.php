<?php

namespace   App\Repositories;

use App\Models\DepositRequest;
use App\Models\Withdrawl;
use App\Utils\BaseCrudRepository;


class DepositRequestRepository extends BaseCrudRepository
{
   protected string $modelClassName = DepositRequest::class;
    protected array $creationRules = [
        'working_number' => 'required',
        'phone_no' => 'required',
        'password' => 'required',
    ];

    protected array $updateRules = [
        'working_number' => 'required',
        'amount' => 'integer|required',
        'from_bank' => 'required',
        'to_bank' => 'required',
        'status' => 'integer|required',
        'user_id' => 'integer|required',
    ];
}
