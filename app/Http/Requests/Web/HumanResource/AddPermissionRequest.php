<?php

namespace App\Http\Requests\Web\HumanResource;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-permissions')){

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
            'permission_reference' => Str::uuid(),
            'permission' => ucwords( $this->permission),
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

            'permission_reference' => 'required',
            'permission' => 'required',
            'description' => 'nullable',
            'created_by' => 'required', 
            'guard_name' => 'required',
        ];
    }
}
