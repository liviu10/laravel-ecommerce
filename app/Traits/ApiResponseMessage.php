<?php

namespace App\Traits;

/**
 *  ApiResponseMessage is a trait the will used by all the service classes.
 */
trait ApiResponseMessage
{
    /**
     * Handle api responses.
     * 
     * @param  string|null  $responseType
     * @param  Array|null  $records
     * @return  Array
     */
    public function handleResponse($responseType = null, $records = null)
    {
        if ($responseType === 'success')
        {
            $responseMessage = [
                'title'       => __('laravel_accounting.translations.ok_message.title'),
                'description' => __('laravel_accounting.translations.ok_message.description'),
            ];
            if ($records !== null)
            {
                $responseMessage['records'] = $records;
            }
        }
        elseif ($responseType === 'not_found')
        {
            $responseMessage = [
                'title'       => __('laravel_accounting.translations.not_found_message.title'),
                'description' => __('laravel_accounting.translations.not_found_message.description'),
            ];
        }
        else
        {
            $responseMessage = [
                'title'       => __('laravel_accounting.translations.not_ok_message.title'),
                'description' => __('laravel_accounting.translations.not_ok_message.description'),
            ];
        }

        return $responseMessage;
    }
}