<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * @return \Admin\UserManagment\User|false
     */
    public static function loginUsingId(mixed $id, bool $remember = false);

    /**
     * @return \Admin\UserManagment\User|false
     */
    public static function onceUsingId(mixed $id);

    /**
     * @return \Admin\UserManagment\User|null
     */
    public static function getUser();

    /**
     * @return \Admin\UserManagment\User
     */
    public static function authenticate();

    /**
     * @return \Admin\UserManagment\User|null
     */
    public static function user();

    /**
     * @return \Admin\UserManagment\User|null
     */
    public static function logoutOtherDevices(string $password);

    /**
     * @return \Admin\UserManagment\User
     */
    public static function getLastAttempted();
}