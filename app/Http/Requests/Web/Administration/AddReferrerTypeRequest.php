<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddReferrerTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('add-referrer-types')){

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
            'referrer_type_reference' => Str::uuid(),
            'referrer_type' => ucwords( $this->referrer_type),
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

            'referrer_type_reference' => 'required',
            'referrer_type' => 'required',
            'description' => 'nullable',
            'created_by' => 'required',
        ];
    }
}
