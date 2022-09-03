<?php

namespace App\Http\Requests;

use App\Http\Requests\enums\InvoiceOptionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceUpdateRequest extends FormRequest
{
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
            'merchant_id' => 'numeric',
            'state' => Rule::in(['new', 'pending payment', 'paid', 'cancelled']),
            'amount' => 'numeric|min:1',
            'option' => Rule::in([InvoiceOptionEnum::link->name, InvoiceOptionEnum::nolink->name]),
            'hook_id' => 'numeric',
            'description' => 'max:128',
            'expiration_date' => 'date|after:tomorrow',
        ];
    }
}
