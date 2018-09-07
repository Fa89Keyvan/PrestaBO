<?php

class HfContactModel
{
    public $ID; //int

    /**
     * Summary of $Code
     * @var string
     */
    public $Code; //String

    public $Name; //String
    public $FirstName; //String
    public $LastName; //String

    /**
     * Summary of $ContactType
     * @var int
     */
    public $ContactType; //int

    public $NationalCode; //String
    public $EconomicCode; //String
    public $RegistrationNumber; //String
    public $Address; //String
    public $City; //String
    public $State; //String
    public $PostalCode; //String
    public $Phone; //String
    public $Fax; //String
    public $Mobile; //String
    public $Email; //String
    public $Website; //String
    public $RegistrationDate; //String
    public $Note; //String
    public $SharePercent; //int
    public $Liability; //int
    public $Credits; //int

    /**
     * Summary of CreateInsertModel
     * @param string $name 
     * @param int $contactType 
     * @return HfContactModel
     */
    private static function CreateInsertModel($name,$contactType){
        $model = new HfContactModel();
        $model->Code = '0000';
        $model->Name = $name;
        $model->ContactType = $contactType;
        return $model;
    }

    const CONTACT_TYPE_UNDEFIEND = 0;
    const CONTACT_TYPE_NATURAL   = 1;
    const CONTACT_TYPE_LEGAL     = 2;

}