<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaction;
use App\Services\TransactionService;
use App\Helpers\TimeHelper;

class TransactionsController extends Controller {

    public function __construct(
            protected TransactionService $transactionService
    )
    {

    }

    public function create(CreateTransaction $request)
    {
        try {
            $this->transactionService->createTransaction($request->all());

            $httpStatus = 201;
            $timeDiff = TimeHelper::dateTimeDiffWithCurrentDate($request->timestamp);

            if ($timeDiff > 60) {
                $httpStatus = 204;
            } else if ($timeDiff < 0) {
                $httpStatus = 422;
            }

            return response('', $httpStatus);
        } catch (Exception $ex) {
            return response('', 400);
        }
    }

    public function delete()
    {
        $this->transactionService->deleteAll();
        return response('', 204);
    }
}
