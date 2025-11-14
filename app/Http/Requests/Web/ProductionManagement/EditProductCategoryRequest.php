<?php

namespace App\Http\Requests\Web\ProductionManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-product-categories')){

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
            
            'product_category' => ucwords( $this->product_category),
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

            'product_category_reference' => 'required',
            'product_category' => 'required',
            'description' => 'nullable', 
             #'is_active' => 'required',
            #'updayed_by'  => 'required', 
            'updated_at' => 'required',
        ];
    }
}
