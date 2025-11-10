<?php

namespace App\Http\Requests\Web\InventoryManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddItemCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-item-categories')){

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
            'item_category_reference' => Str::uuid(),
            'item_category' => ucwords( $this->item_category),
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

            'item_category_reference' => 'required',
            'item_category' => 'required',
            'description' => 'nullable', 
            'group_id' => 'required|exists:groups,id',
            #'is_active' => 'required',
            'created_by'  => 'required', 
        ];
    }
}
