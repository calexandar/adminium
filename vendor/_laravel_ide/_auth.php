<?php

namespace Illuminate\Contracts\Auth;

interface Guard
{
    /**
     * @return \Admin\UserManagment\User|null
     */
    public function user();
}