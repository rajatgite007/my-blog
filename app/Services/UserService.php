<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function getNextId()
    {
        return User::max('user_id') + 1;
    }

    public function create($data)
    {
        $data['creator_user_id'] = authUserId();
        return User::create($data);
    }

    public function update($user_id, $data)
    {
        $data['creator_user_id'] = authUserId();
        return User::where('user_id','=', $user_id)->update($data);
    }

    public function listQuery()
    {
        $query = User::orderBy('users.name', 'ASC');

        if(!isSuperAdmin()){
            $query->where('users.company_id', authCompanyId());
        }

        return $query;
    }

    public function getUserById($user_id)
    {
        $query = User::where('users.user_id', $user_id);

        if(!isSuperAdmin()){
            $query->where('users.company_id', authCompanyId());
        }

        return $query->first();
    }

    public function isPasswordValid($password)
    {
        //validations
        $data = [
            'password' => $password
            // Other fields...
        ];

        // Validation rules
        $rules = [
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]+$/',
            ],
            // Other rules for other fields...
        ];

        // Custom error messages
        $messages = [
            'password' => trans('translation.minimum_8_characters_with_a_symbol_a_cap_and_a_number'),
        ];

        // Perform validation
        $validator = Validator::make($data, $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return ['valid'=> false, 'errors'=> $validator->errors()->all()];
        } else {
            return ['valid'=> true, 'errors'=> []];
        }
    }
    

}
