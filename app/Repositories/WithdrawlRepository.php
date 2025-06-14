<?php

namespace   App\Repositories;

use App\Models\DepositRequest;
use App\Models\Withdrawl;
use App\Utils\BaseCrudRepository;


class WithdrawlRepository extends BaseCrudRepository
{
   protected string $modelClassName = Withdrawl::class;
    protected array $creationRules = [
        'working_number' => 'required|integer',
        'phone_no' => 'required',
        'password' => 'required',
    ];

    protected array $updateRules = [
        'working_number' => 'integer|required',
        'amount' => 'integer|required',
        'from_bank' => 'required',
        'to_bank' => 'required',
        'status' => 'integer|required',
        'user_id' => 'integer|required',
    ];
}
