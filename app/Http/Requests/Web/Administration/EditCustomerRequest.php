<?php

namespace App\Http\Requests\Web\Administration;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use Str;
use Carbon\carbon;

class EditCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function authorize(): bool
    {

        if(Auth::user()->can('add-customers')){

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
            'phone_number' => isset($this->phone_number) ? '256'.''.str_replace(' ', '', $this->phone_number) : null,
            'alternative_phone' => isset($this->alternative_phone) ? '256'.''.str_replace(' ', '', $this->alternative_phone) : null,
            'physical_address' => isset($this->physical_address) ? ucwords($this->physical_address) : null,
            'contact_first_name' => isset($this->contact_first_name) ? ucwords($this->contact_first_name) : null,
            'contact_last_name' => isset($this->contact_last_name) ? ucwords($this->contact_last_name) : null,
            'contact_other_name' => isset($this->contact_other_name) ? ucwords($this->contact_other_name) : null,
            'contact_phone_number' => isset($this->contact_phone_number) ? '256'.''.str_replace(' ', '', $this->contact_phone_number) : null,
            'contact_alternative_phone' => isset($this->contact_alternative_phone) ? '256'.''.str_replace(' ', '', $this->contact_alternative_phone) : null,
            'contact_date_of_birth' => isset($this->contact_date_of_birth) ? ($this->contact_date_of_birth) : null,  
            'contact_gender' => isset($this->contact_gender) ? ucwords($this->contact_gender) : null,        
            'updated_by' => $user->id, 
            'updated_at' => Carbon::now(),
                     
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

            'edit_customer_id' => 'required',
            'customer_reference' => 'required',
            'customer_type_id' => 'required',            
            'national_identification_number' => 'nullable|string|max:15',
            'tax_identification_number' => 'nullable|string|max:15',
            'customer' => 'required|string',
            'phone_number' => 'required|string|size:12|unique:customers,phone_number,'.$this->edit_customer_id,
            'alternative_phone' => 'nullable|string|size:12',
            'email_address' => 'required|email|unique:customers,email_address,'.$this->edit_customer_id,
            'alternative_email' => 'nullable|email',
            'physical_address' => 'nullable|string',

            'contact_first_name' => 'required|string|max:225',
            'contact_last_name' => 'required|string|max:225',
            'contact_other_name' => 'nullable|string|max:225',
            'contact_phone_number' => 'required|string|size:12',
            'contact_alternative_phone' => 'nullable|string|size:12',
            'contact_email_address' => 'required|email',
            'contact_alternative_email' => 'nullable|email',
            'position_id' => 'required', 
            'contact_physical_address' => 'nullable|string',
            'contact_gender' => 'nullable|in:Male,Female,Other', 
            'contact_date_of_birth' => 'nullable|date',            
            
            'updated_by' => 'required|exists:users,id',
            'updated_at' => 'required',
            
            'referrer_type_id' => 'required', 
            'referrer_type' => 'required',
            'user_id' => 'required_if:referrer_type,Employee',
            'customer_id' => 'required_if:referrer_type,Customer',
            'supplier_id' => 'required_if:referrer_type,Supplier',
            'referrer_id' => 'required_if:referrer_type,Others',
            
        ];
    }


    public function messages(){

        return [

            'customer_type_id.required' => 'Customer Type is required',
            'position_id.required' => 'Position is required',
            'referrer_type_id.required' => 'Referrer Type is required',

            'customer_id.required_if' => 'Customer Referrer is required',
            'supplier_id.required_if' => 'Supplier Referrer is required',
            'user_id.required_if' => 'Employee Referrer is required',
            'referrer_id.required_if' => 'Referrer is required',
        ];
    }



}
