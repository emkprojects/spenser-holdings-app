<?php

namespace App\Http\Requests\Web\InventoryManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditItemCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-item-categories')){

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
           
            'item_category' => ucwords( $this->item_category),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'updated_at'  => Carbon::now(),
            'updated_by'  => $user->id,
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
            #'item_id' => 'required|exists:item_categories,id',
            'item_category_reference' => 'required|exists:item_categories,item_category_reference',
            'item_category' => 'required',
            'description' => 'nullable', 
            'group_id' => 'required|exists:groups,id',
            'is_active' => 'required',
            'updated_at' => 'required',
            'updated_by'  => 'required',                
        ];
    }
}
