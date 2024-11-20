<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function redirectTo()
    {
        return 'dashboard';
    }

    public function validationError($errors)
    {
        $errorCnt = $errors->count();
        $message = $errors->first();
        $message .= ($errorCnt > 1) ? ' (and ' . $errorCnt - 1 . ' more error)' : '' ;
        return response()->json([
            'message'  => $message,
            'errors' => $errors,
        ], 422);
    }

    public function customePagination($total, $filteredQuery)
    {
      // Get filtered total count
      $filteredTotal = $filteredQuery->count();

      // Paginate the filtered results
      $paginatedResults = $filteredQuery->paginate($request->perPage ?? 10);

      return response()->json(array(
        'current_page' => $paginatedResults->currentPage(),
        'from' => $paginatedResults->firstItem(),
        'to' => $paginatedResults->lastItem(),
        'last_page' => $paginatedResults->lastPage(),
        'per_page' => $paginatedResults->perPage(),
        'data' => $paginatedResults->items(),
        'filtered_total' => $filteredTotal,
        'total' => $total
      ));
    }
}
