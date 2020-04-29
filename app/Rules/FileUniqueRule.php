<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileUniqueRule implements Rule
{
    private $name;

    /**
     * FileUniqueRule constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $path = env("user_directory", "/tmp") . "/" . $this->name;
        return !file_exists($path);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'File Exists.';
    }
}
