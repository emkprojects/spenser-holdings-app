<?php

namespace App\Http\Requests\Web\HumanResource;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-roles')){

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
            'role_reference' => Str::uuid(),
            'role' => ucwords( $this->role),
            'description' => isset($this->description) ? ucfirst( $this->description) : null,
            'created_by' => $user->id,
            'guard_name' => 'web',
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

            'role_reference' => 'required',
            'role' => 'required',
            'description' => 'nullable',
            'created_by' => 'required', 
            'guard_name' => 'required',
        ];
    }
}
