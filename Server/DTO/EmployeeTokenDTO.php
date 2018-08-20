<?php

/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/17/2018
 * Time: 8:03 PM
 */
class EmployeeTokenDTO extends BaseResponseDTO
{
    function __construct()
    {
        $this->urls = array();
    }

    /**
     * @var string
     */
    public $FirstName;

    /**
     * @var string
     */
    public $LastName;

    /**
     * @var string
     */
    public $Email;

    /**
     * @var string
     */
    public $Token;

    /**
     * @var EmployeeAccessUrlModel[]
     */
    public $urls;


}