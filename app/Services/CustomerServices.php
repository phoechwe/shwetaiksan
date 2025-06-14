<?php

namespace App\Services;

use App\Models\PaymentRecord;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomerServices
{
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function createUser($data)
    {
        return $this->customerRepository->createData($data);
    }

    public function getUserById($id)
    {
        return $this->customerRepository->getById($id);
    }

    public function updateUser($id, $data)
    {
        return $this->customerRepository->updateData($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->customerRepository->deleteData($id);
    }

    public function getPaymentRecord($user_id , $perPage = 40, )
    {
        $pyament_record = PaymentRecord::where('user_id' ,$user_id)->with('user')->get();
        return $pyament_record;
    }
    public function getAllUsers($perPage = 40, $selectRole = null, $search = "")
    {

        $query = [
            "search" => $search,
            "search_columns" => ["name", "email"],
            "where_has" => [
                "roles" => [
                    ["title", "=", "User"]
                ]
            ]
        ];
        return $this->customerRepository->paginateData($perPage, $query);
    }
}
