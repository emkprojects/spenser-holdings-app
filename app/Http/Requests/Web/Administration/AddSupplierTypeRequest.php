<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddSupplierTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-supplier-types')){

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
            'supplier_type_reference' => Str::uuid(),
            'supplier_type' => ucwords( $this->supplier_type),
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

            'supplier_type_reference' => 'required',
            'supplier_type' => 'required',
            'description' => 'nullable',
            'created_by' => 'required',
        ];
    }
}
