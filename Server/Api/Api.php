<?php

$q = GetQueryValue('q');

if($q === 'login'){
    EmployeeApi::Login();
}
else{

    $token = GetPostedValue('token');
    
    $employeeStore = new EmployeeStore();
    $id_employee  = $employeeStore->ValidateToken($token);
    if($id_employee === -1)
    {
        http_response_code(403);
        die();
    }
    else
    {
        $employeeAccessStore = new EmployeeAccessStore();
        $hasAccess = $employeeAccessStore->HasAccess($id_employee,$q);
        if(!$hasAccess)
        {
            http_response_code(403);
            die();    
        }
        else
        {
            switch($q)
            {
                case 'HfContacts_GetAll': 
                    HfContactApi::GetAll(); 
                    break;
                default: 
                    http_response_code(404);                 
                    break;
            }
        }
    }
}