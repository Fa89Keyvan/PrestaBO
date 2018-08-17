<?php

/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/17/2018
 * Time: 8:14 PM
 */
class BaseResponseDTO
{
    /**
     * @var bool
     */
    public $HasError;

    /**
     * @var int
     */
    public $ErrorCode;


    const ERROR_USER_NOT_FOUND = -1;
}