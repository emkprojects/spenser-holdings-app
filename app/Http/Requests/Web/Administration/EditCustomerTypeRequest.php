<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditCustomerTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function authorize(): bool
    {

        if(Auth::user()->can('edit-customer-types')){

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
            'customer_type' => ucwords( $this->customer_type),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'updated_by' => $user->id,
            'updated_at' => Carbon::now(),
            
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

            #'customer_type_id' => 'required',
            'customer_type_reference' => 'required',
            'customer_type' => 'required',
            'description' => 'nullable',
            'is_active' => 'required',
            #'updated_by' => 'required',
            'updated_at' => 'required',
        ];
    }
}
