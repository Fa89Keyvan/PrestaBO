<?php

$q = GetPostedValue('q');
$employeeStore       = new EmployeeStore();
$employeeAccessStore = new EmployeeAccessStore();

if($q != null){

    switch($q)
    {
        case 'login': Login($employeeStore,$employeeAccessStore); break;
        default: http_response_code(400);
    }
}
else{
    http_response_code(400);
}

/**
 * @param $employeeStore       EmployeeStore
 * @param $employeeAccessStore EmployeeAccessStore
 */
function Login($employeeStore,$employeeAccessStore){

    $email    = GetPostedValue('email');
    $password = GetPostedValue('password');

    if($email == null || $password == null)
        http_response_code(400);
    else
    {
        $employeeTokenDTO = new EmployeeTokenDTO();
        $employeeModel    = $employeeStore->GetEmployee($email,$password);

        if($employeeModel == null)
        {
            $employeeTokenDTO->HasError = true;
            $employeeTokenDTO->ErrorCode = BaseResponseDTO::ERROR_USER_NOT_FOUND;
            echo Tools::ToJson($employeeTokenDTO);
        }
        else
        {
            $tokenModel      = $employeeStore->GetToken($employeeModel->id_employee);

            $employeeTokenDTO->Email     = $employeeModel->email;
            $employeeTokenDTO->FirstName = $employeeModel->firstname;
            $employeeTokenDTO->LastName  = $employeeModel->lastname;
            $employeeTokenDTO->Token     = $tokenModel->token;
            $employeeTokenDTO->HasError  = false;

            $urls = $employeeAccessStore->SelectEmployeeUrls($employeeModel->id_employee);

            if(count($urls)>0){
                foreach($urls as $url){
                    array_push($employeeTokenDTO->urls,$url);
                }
            }

            echo Tools::ToJson($employeeTokenDTO);
        }
    }
}