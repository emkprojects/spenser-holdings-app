<?php

namespace App\Http\Requests\Web\ProductionManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddInventoryCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-inventory-categories')){

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
            'inventory_category_reference' => Str::uuid(),
            'inventory_category' => ucwords( $this->inventory_category),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'created_by'  => $user->id,
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

            'inventory_category_reference' => 'required',
            'inventory_category' => 'required',
            'description' => 'nullable', 
             #'is_active' => 'required',
            'created_by'  => 'required', 
        ];
    }
}
