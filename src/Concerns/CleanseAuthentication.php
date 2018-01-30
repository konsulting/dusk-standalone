<?php

namespace Konsulting\DuskStandalone\Concerns;

trait CleanseAuthentication
{
    /**
     * Log into the application as the default user.
     *
     * @return $this
     */
    public function login()
    {
        throw new \Exception('Authentication methods must be specifically enabled.');
    }

    /**
     * Log into the application using a given user ID or email.
     *
     * @param  object|string $userId
     * @param  string        $guard
     *
     * @return $this
     */
    public function loginAs($userId, $guard = null)
    {
        throw new \Exception('Authentication methods must be specifically enabled.');
    }

    /**
     * Log out of the application.
     *
     * @param  string $guard
     *
     * @return $this
     */
    public function logout($guard = null)
    {
        throw new \Exception('Authentication methods must be specifically enabled.');
    }

    /**
     * Get the ID and the class name of the authenticated user.
     *
     * @param  string|null $guard
     *
     * @return array
     */
    protected function currentUserInfo($guard = null)
    {
        throw new \Exception('Authentication methods must be specifically enabled.');
    }
}
