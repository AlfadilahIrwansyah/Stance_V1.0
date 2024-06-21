<?php

namespace App\Rules;

use App\Models\RefUser;
use Illuminate\Contracts\Validation\Rule;

class IsActivated implements Rule
{

    protected $EMAIL;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($EMAIL)
    {
        $this->email = $EMAIL;
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
        $user = RefUser::where('EMAIL', $this->email)->first();
        return $user && $user->is_activated;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your account is not activated. or not registered';
    }
}
