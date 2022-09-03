<?php

namespace App\Http\Requests;

use App\Http\Requests\enums\InvoiceOptionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceCreateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'merchant_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'option' => ['required', Rule::in(InvoiceOptionEnum::link->name, InvoiceOptionEnum::nolink->name)],
            'description' => 'max:128',
            'expiration_date' => 'date|after:tomorrow',
            'hooks.success' => 'url',
            'hooks.fail' => 'url',
            'hooks.expired' => 'url',
            'external_id' => 'required|string|max:64'
        ];
    }
}
