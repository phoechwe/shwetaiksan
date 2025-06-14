<?php 
namespace App\Repositories;
use App\Models\Twodledger;
use App\Services\TwodledgerServices;
use App\Utils\BaseCrudRepository;

class TwodledgerRepository extends BaseCrudRepository
{
    /**
     *  The model class to manage services
     */
   protected string $modelClassName = Twodledger::class;

    protected array $creationRules = [
            'date' => 'required|date',
            'session_time' => 'required|integer',
            'amount' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
    ];
    protected array $updateRules = [
            'date' => 'required|date',
            'session_time' => 'required|integer',
            'amount' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
    ];
}