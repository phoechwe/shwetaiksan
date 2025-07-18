<?php

namespace   App\Repositories;

use App\Models\PaymentRecord;
use App\Models\ThreedLedgerNumber;
use App\Models\TwodledgerNumber;
use App\Models\User;
use App\Utils\BaseCrudRepository;


class ThreedBetRepository extends BaseCrudRepository
{
    protected string $modelClassName = ThreedLedgerNumber::class;
}
