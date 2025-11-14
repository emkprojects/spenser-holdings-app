<?php

namespace App\Http\Requests\Web\ProductionManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditInventoryCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-inventory-categories')){

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
            
            'inventory_category' => ucwords( $this->inventory_category),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'updated_by'  => $user->id,
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

            'inventory_category_reference' => 'required',
            'inventory_category' => 'required',
            'description' => 'nullable', 
             #'is_active' => 'required',
            #'updated_by'  => 'required', 
            'updated_at' => 'required',
        ];
    }
}
