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

            /**
             * TODO: Levar validação para o Request
             */
            $timeDiff = TimeHelper::dateTimeDiffWithCurrentDate($request->timestamp);
            if ($timeDiff < 0) {
                return response('', 422);
            }

            $httpStatus = 201;
            if ($timeDiff > 60) {
                $httpStatus = 204;
            }

            $this->transactionService->createTransaction($request->all());

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
