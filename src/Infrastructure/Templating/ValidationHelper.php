<?php

namespace Infrastructure\Templating;

class ValidationHelper implements \ArrayAccess
{
    private array $errors = [];

    public function print(string $proprtyPath)
    {
        $output = '';

        foreach ($this->errors[$proprtyPath] ?? [] as $message) {
            $output .= sprintf('<label id="%1$s-error" class="error" for="%1$s">%2$s</label>', $proprtyPath, $message);
        }

        return $output;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = array_merge_recursive($errors, $this->errors);
    }

    public function offsetExists($offset)
    {
        return (bool) @$this->errors[$offset];
    }

    public function offsetGet($offset)
    {
        return $this->errors[$offset] ?? [];
    }

    public function offsetSet($offset, $value)
    {
        $this->errors[$offset][] = $value;
    }

    public function offsetUnset($offset)
    {
        throw new \Exception('Cannot unset validation error');
    }
}
