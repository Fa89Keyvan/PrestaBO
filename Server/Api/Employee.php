<?php

$q = GetPostedValue('q');
$employeeStore = new EmployeeStore();

if($q != null){

    switch($q)
    {
        case 'login': Login($employeeStore); break;
        default: http_response_code(400);
    }
}
else{
    http_response_code(400);
}

/**
 * @param $employeeStore EmployeeStore
 */
function Login($employeeStore){

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
            $employeeTokenDTO->ErrorCode = BaseResponse::ERROR_USER_NOT_FOUND;
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
            echo Tools::ToJson($employeeTokenDTO);
        }
    }
}