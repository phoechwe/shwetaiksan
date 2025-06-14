<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

trait PaginateModels
{
    public function getPaginatedResults(
        string $modelClass,
        int $perPage = 20,
        ?array $options = []
    ): LengthAwarePaginator {

        $query = $modelClass::query();

        // Eager Loading
        if (!empty($options["with"])) $query->with($options["with"]);
        if (!empty($options["where"])) $query->where($options["where"]);

        // WHERE BETWEEN conditions
        if (!empty($options["where_between"])) {
            foreach ($options["where_between"] as $column => $range) {
                if (is_array($range) && count($range) === 2) {
                    $query->whereBetween($column, $range);
                }
            }
        }
        // Or Where Query 
        if (!empty($options["or_where"])) {
            $query->where(function ($q) use ($options) {
                foreach ($options["or_where"] as $condition) {
                    // Each condition should be ['column', 'operator', 'value']
                    [$column, $operator, $value] = $condition;
                    $q->orWhere($column, $operator, $value);
                }
            });
        }

        // where has query
        if (!empty($options["where_has"])) {
            foreach ($options["where_has"] as $relation => $conditions) {
                $query->whereHas($relation, function ($q) use ($conditions) {
                    foreach ($conditions as $condition) {
                        [$column, $operator, $value] = $condition;
                        if (!empty($value)) $q->where($column, $operator, $value);
                    }
                });
            }
        }



        // search query
        if ((!empty($options["search"]))) {
            $searchTerm = $options["search"];
            $searchColumns = $options["search_columns"] ?? ["id"];

            $query->where(function ($q) use ($searchTerm, $searchColumns) {
                foreach ((array) $searchColumns as $column) {
                    $q->orWhere($column, 'like', "%{$searchTerm}%");
                }
            });
        }

        // where has condition for relation filtering
        if (!empty($options["where_has"])) {
            foreach ($options["where_has"] as $relation => $conditions) {
                $query->whereHas($relation, function ($q) use ($conditions) {
                    foreach ($conditions as $condition) {
                        [$column, $operator, $value] = $condition;
                        if (!empty($value)) $q->where($column, $operator, $value);
                    }
                });
            }
        }

        // Custom query
        if (!empty($options["custom_query"])) {
            $options["custom_query"]($query);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
