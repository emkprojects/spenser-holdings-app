<?php

namespace App\Http\Requests\Web\HumanResource;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-users')){

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

            'national_identification_number' => isset($this->national_identification_number) ? strtoupper($this->national_identification_number) : "",
            'first_name' => isset($this->first_name) ? ucwords($this->first_name) : "",
            'last_name' => isset($this->last_name) ? ucwords($this->last_name) : "",
            'other_name' => isset($this->other_name) ? ucwords($this->other_name) : "",
            'gender' => isset($this->gender) ? ucwords($this->gender) : "",
            'physical_address' => isset($this->physical_address) ? ucwords($this->physical_address) : "",            
            'phone' => isset($this->phone) ? '256'.''.str_replace(' ', '', $this->phone) : "",            
            'alternative_phone' => isset($this->alternative_phone) ? '256'.''.str_replace(' ', '', $this->alternative_phone) : "",
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
        
            'user_id' => 'required|exists:users,id',
            'user_reference' => 'required|exists:users,user_reference',
            'national_identification_number' => 'nullable|string|max:15',
            'first_name' => 'required|string|max:225',
            'last_name' => 'required|string|max:225',
            'other_name' => 'nullable|string|max:225',
            'phone' => 'required|string|size:12|unique:users,phone,'.$this->user_id,
            'alternative_phone' => 'nullable|string|size:12',            
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'alternative_email' => 'nullable|email',
            'date_of_birth' => 'required|date',            
            'role_id' => 'required',
            'position_id' => 'required',
            'user_status_id' => 'required',
            'gender' => 'required|in:Male,Female,Other',            
            'physical_address' => 'nullable|string',
                        
        ];
    }


    public function messages():array{
        return [

            'first_name.required'=> 'First Name is required',
            'last_name.required'=> 'Last Name is required',
            'phone.required'=> 'Phone Number is required',
            'phone.size:12'=> 'Phone Number should be 12 digits',
            'alternative_phone.size:12'=> 'Alternative Phone Number should be 12 digits',            
            'email.required'=> 'Email Address is required',
            'physical_address.required'=> 'Physical Address should only be string',
            'gender.in'=> 'Gender should either be Male or Female or Other',
            'date_of_birth.required'=> 'Date of Birth is required',
            'date_of_birth.date'=> 'Date of Birth is not a valid date',
            'role_id.required'=> 'Role is required',
            'position_id.required'=> 'Position is required',

        ];
    }



}
