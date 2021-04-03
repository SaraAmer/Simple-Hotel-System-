<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ReceptionistUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
        
        return [
            'name' => ['required'],
            'email'=>['unique:users,email,'.$this->receptionist.''],
            'national_id'=> ['digits:14' , 'unique:receptionists,national_id,'.$this->receptionist.''],
            'avatar_image' => 'mimes:jpg,png'
        ];
    }
}
