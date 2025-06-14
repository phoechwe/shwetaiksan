<?php

namespace   App\Repositories;

use App\Models\PaymentRecord;
use App\Models\User;
use App\Utils\BaseCrudRepository;


class PaymentRecordRepository extends BaseCrudRepository
{
   protected string $modelClassName = PaymentRecord::class;
}
