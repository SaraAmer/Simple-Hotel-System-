<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Manager;

class ManagerUpdateRequest extends FormRequest
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
        $mangeruser = User::where('user_id', (int)$this->manager)->where('role', 'Manager')->first();
        $mangeruser=$mangeruser->id;
       
        return [
            
            'name' => ['required'],
            'email'=>['unique:users,email,'.$mangeruser.''],
            'national_id'=> ['min:14' ,'max:14' , 'unique:managers,national_id,'.$this->manager.''],
            'avatar_image' => 'mimes:jpg,png'
        ];
    }
}
