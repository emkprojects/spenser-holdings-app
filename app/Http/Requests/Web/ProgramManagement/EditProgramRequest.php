<?php

namespace App\Http\Requests\Web\ProgramManagement;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Str;

class EditProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // if(Auth::user()->can('update-program')){

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
           
            'program' => strtoupper( $this->program),
            'description' => isset($this->description) ? ucwords( $this->description) : null,  
            //'updated_by'  => $user->id,
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
            'program_reference' => 'required|exists:programs,program_reference',
            'program' => 'required',
            'description' => 'nullable',  
            //'updated_by'  => 'required',                
        ];
    }
}
