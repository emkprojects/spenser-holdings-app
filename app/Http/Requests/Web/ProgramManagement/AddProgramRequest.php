<?php

namespace App\Http\Requests\Web\ProgramManagement;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class AddProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // if(Auth::user()->can('create-program')){

        //     return true;
        // }

        // else{

        //     return false;
        // }

        return true;
    }


    protected function prepareForValidation(){
        
        $user =  Auth::user();

        $this->merge([
           
            'program_reference' => Str::uuid(),
            'program' => strtoupper( $this->program),
            'description' => isset($this->description) ? ucwords( $this->description) : null,  
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
            'program_reference' => 'required',
            'program' => 'required',
            'description' => 'nullable',  
            'created_by'  => 'required',                
        ];
    }
}
