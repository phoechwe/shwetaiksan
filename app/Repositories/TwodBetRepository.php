<?php

namespace   App\Repositories;

use App\Models\PaymentRecord;
use App\Models\TwodledgerNumber;
use App\Models\User;
use App\Utils\BaseCrudRepository;


class TwodBetRepository extends BaseCrudRepository
{
   protected string $modelClassName = TwodledgerNumber::class;
}
