<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler {

    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException)
        {
            // Custom logic for model not found...
        }

        return parent::render($request, $e);
    }

}