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
        $Recetionistuser = User::where('user_id', (int)$this->receptionist)->where('role', 'Receptionist')->first();
        $receptionistuser=$Recetionistuser->id;
        
        return [
            'name' => ['required'],
            'email'=>['unique:users,email,'.$receptionistuser.''],
            'national_id'=> ['min:14' ,'max:14' , 'unique:receptionists,national_id,'.$this->receptionist.''],
            'avatar_image' => 'mimes:jpg,png'
        ];
    }
}
