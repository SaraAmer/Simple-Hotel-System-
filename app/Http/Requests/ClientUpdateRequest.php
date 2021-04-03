<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Client;
use App\Models\User;

class ClientUpdateRequest extends FormRequest
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
        $client = Client::find($this->client);
     
        $user= User::where('email', $client['email'])->first();
      
        $userId=$user['id'];
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
            'unique:clients,email,'.$this->client.'',
            Rule::unique('users', 'email')->ignore($userId)],
            'mobile'=>['digits:11' ,'required'],
            
        ];
    }
}
