<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaction;
use App\Services\TransactionService;

class TransactionsController extends Controller {

    public function __construct(
            protected TransactionService $transactionService
    )
    {

    }

    public function create(CreateTransaction $request)
    {
        try {
            $result = $this->transactionService->createTransaction(
                    $request->all()
            );

            return response('', $result);
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
