<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \Admin\UserManagment\User|null
     */
    public function user($guard = null);
}