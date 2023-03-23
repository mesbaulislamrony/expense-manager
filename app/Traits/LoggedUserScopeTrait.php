<?php

namespace App\Traits;

use App\Models\Scopes\LoggedUserScope;

trait LoggedUserScopeTrait
{
    /*
     * Scope Declarations
     * Global scope define as per requirements.
     *
     */

    protected static function booted()
    {
        static::addGlobalScope(new LoggedUserScope);
    }
}
