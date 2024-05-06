<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\RoleActivityNotifications;
use Spatie\Permission\Models\Role;


class RoleNotifyObserver
{

    public $admin;
    public $title;

    public function __construct()
    {
        $this->admin = User::first();
        $this->title = 'Role Activity';
    }

    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        $body = 'Role ' . $role->name . ' added to you database';

        $this->admin->notify(new RoleActivityNotifications($this->title, $body));
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        $body = 'Role ' . $role->name . ' update in you database';

        $this->admin->notify(new RoleActivityNotifications($this->title, $body));
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        $body = 'Role ' . $role->name . ' deleted from you database';

        $this->admin->notify(new RoleActivityNotifications($this->title, $body));
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        $body = 'Role ' . $role->name . ' restored to you database';

        $this->admin->notify(new RoleActivityNotifications($this->title, $body));
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        $body = 'Role ' . $role->name . ' force deleted from you database';

        $this->admin->notify(new RoleActivityNotifications($this->title, $body));
    }
}
