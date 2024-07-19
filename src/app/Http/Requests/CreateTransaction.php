<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\TimeHelper;
use Closure;

class CreateTransaction extends FormRequest {

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|decimal:0,2',
            'timestamp' => [
                'required',
                'date_format:Y-m-d\TH:i:s.v\Z',
                function (string $attribute, mixed $value, Closure $fail) {
                    $timeDiff = TimeHelper::dateTimeDiffWithCurrentDate($value);
                    if ($timeDiff < 0) {
                        $fail("The {$attribute} is invalid.");
                    }
                },
            ]
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response('', 422));
    }
}
