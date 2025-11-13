<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditReferrerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        if(Auth::user()->can('edit-referrers')){

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

            'national_identification_number' => isset($this->national_identification_number) ? strtoupper($this->national_identification_number) : null,
            'tax_identification_number' => isset($this->tax_identification_number) ? strtoupper($this->tax_identification_number) : null,
            'first_name' => isset($this->first_name) ? ucwords($this->first_name) : null,
            'last_name' => isset($this->last_name) ? ucwords($this->last_name) : null,
            'other_name' => isset($this->other_name) ? ucwords($this->other_name) : null,
            'phone_number' => isset($this->phone_number) ? '256'.''.str_replace(' ', '', $this->phone_number) : null,
            'alternative_phone' => isset($this->alternative_phone) ? '256'.''.str_replace(' ', '', $this->alternative_phone) : null,
            'physical_address' => isset($this->physical_address) ? ucwords($this->physical_address) : null,               
            'gender' => isset($this->gender) ? ucwords($this->gender) : null,        
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
        
            'referrer_id' => 'required|exists:referrers,id',
            'referrer_reference' => 'required|exists:referrers,referrer_reference',
            'referrer_type_id' => 'required',
            'national_identification_number' => 'nullable|string|max:15',
            'first_name' => 'required|string|max:225',
            'last_name' => 'required|string|max:225',
            'other_name' => 'nullable|string|max:225',
            'phone_number' => 'required|string|size:12|unique:referrers,phone_number,'.$this->referrer_id,
            'alternative_phone' => 'nullable|string|size:12',            
            'email_address' => 'required|email|unique:referrers,email_address,'.$this->referrer_id,
            'alternative_email' => 'nullable|email',
            'date_of_birth' => 'nullable|date',
            'is_active' => 'required',
            'gender' => 'required|in:Male,Female,Other',            
            'physical_address' => 'nullable|string',
            'updated_by' => 'required|exists:users,id',
            
                        
        ];
    }


    public function messages():array{
        return [

            'first_name.required'=> 'First Name is required',
            'last_name.required'=> 'Last Name is required',
            'phone_number.required'=> 'Phone Number is required',
            'phone_number.size:12'=> 'Phone Number should be 12 digits',
            'alternative_phone.size:12'=> 'Alternative Phone Number should be 12 digits',            
            'email_address.required'=> 'Email Address is required',
            'physical_address.required'=> 'Physical Address should only be string',
            'gender.in'=> 'Gender should either be Male or Female or Other',
            //'date_of_birth.required'=> 'Date of Birth is required',
            'date_of_birth.date'=> 'Date of Birth is not a valid date',           

        ];
    }


}
