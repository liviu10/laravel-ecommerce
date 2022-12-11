<?php

namespace App\Traits;

/**
 *  ApiLogError is a trait the will used by all the model classes.
 */
trait ApiLogError
{
    /**
     * Handle api log errors.
     * @param  object  $mysqlError
     * @return  void
     */
    public function handleApiLogError($mysqlError)
    {
        $logError = [
            'code'        => $mysqlError->getCode(),
            'description' => $mysqlError->getMessage()
        ];
        dump($logError);
    }
}