<?php

namespace App\Http\Helpers;

use App\Models\User;


class UserHelper
{
    public static function getNameByUserId($id)
    {
        return User::where('id', $id)->value('name') ?? 'Sem nome';
    }
}