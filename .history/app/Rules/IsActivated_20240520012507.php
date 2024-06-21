<?php

namespace App\Rules;

use App\Models\RefUser;
use Illuminate\Contracts\Validation\Rule;

class IsActivated implements Rule
{

    protected $email;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = RefUser::where('email', $this->email)->first();
        dd
        return $user && $user->is_activated;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your account is not activated.';
    }
}
