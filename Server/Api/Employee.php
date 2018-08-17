<?php

$q = GetPostedValue('q');

if($q != null){

    $employeeStore = new EmployeeStore();

    if($q == 'login')
    {

        $email    = GetPostedValue('email');
        $password = GetPostedValue('password');

        if($email == null || $password == null)
            http_response_code(400);
        else
        {
            $employee = $employeeStore->GetEmployee($email,$password);

            echo json_encode($employee);

            $res = $employeeStore->GetToken($employee->id_employee);
            echo json_encode($res);
        }
    }
    else
    {
        http_response_code(400);
    }
}
else{
    http_response_code(400);
}

