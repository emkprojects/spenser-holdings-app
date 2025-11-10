<?php

namespace App\Http\Requests\Web\HumanResource;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-roles')){

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
            #'role_reference' => Str::uuid(),
            'role' => ucwords( $this->role),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'updated_at' => Carbon::now(),
            'updated_by' => $user->id,
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

            'role_id' => 'required|exists:roles,id',
            #'role_reference' => 'required|exists:roles,role_reference',            
            'role' => 'required',
            'description' => 'nullable',
            'is_active' => 'required',
            'updated_at' => 'required', 
            'updated_by' => 'required', 
        ];
    }
}
