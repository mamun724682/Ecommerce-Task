<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class OrderEmptyCartException extends Exception
{
    public function __construct(string $message = "Please add some products to cart!", int $code = Response::HTTP_NOT_ACCEPTABLE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
