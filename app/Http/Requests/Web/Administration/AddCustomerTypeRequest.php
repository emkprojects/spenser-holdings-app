<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddCustomerTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-customer-types')){

            return true;
        }

        else{

            return false;
        }

        #return true;
    }

    protected function prepareForValidation(){
        
        $user =  Auth::user();

        $this->merge([
            'customer_type_reference' => Str::uuid(),
            'customer_type' => ucwords( $this->customer_type),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'created_by' => $user->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'customer_type_reference' => 'required',
            'customer_type' => 'required',
            'description' => 'nullable',
            'created_by' => 'required',
        ];
    }
}
