<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewEmail(User $authUser, User $profileUser)
    {
        return $authUser->id === $profileUser->id;
    }

    public function viewPassword(User $authUser, User $passwordUser)
    {
       return $authUser->id === $passwordUser->id;
    }
    public function viewEdit(User $authUser, User $EditUser)
    {
       return $authUser->id === $EditUser->id;
    }

    public function viewAllEvaluationsForStudent(User $user, User $student): bool
    {
        return $user->role === 'teacher' && $student->role === 'student';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
