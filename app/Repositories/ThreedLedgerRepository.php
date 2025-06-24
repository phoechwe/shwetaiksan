<?php 
namespace App\Repositories;

use App\Models\ThreedLedger;
use App\Models\Twodledger;
use App\Services\TwodledgerServices;
use App\Utils\BaseCrudRepository;

class ThreedLedgerRepository extends BaseCrudRepository
{
    /**
     *  The model class to manage services
     */
   protected string $modelClassName = ThreedLedger::class;

    protected array $creationRules = [
            'start_date' => 'required',
            'amount' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
    ];
    protected array $updateRules = [
            'start_date' => 'required',
            'amount' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
    ];
}