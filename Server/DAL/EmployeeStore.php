<?php

class EmployeeStore
{

    const SELECT_EMPLOYEE =
        'select e.id_employee,e.firstname,e.lastname,e.email,e.passwd
	      from	ps_employee e
	      where e.email  = ?
	      and   e.passwd = ?';

    const SELECT_TOKEN = 'SELECT * FROM bo_tokens t WHERE t.id_employee = ?';
    const INSERT_TOKEN = 'INSERT INTO bo_tokens(id_employee,token,created_date) VALUES(?,?,?)';

    private $db;
    function __construct()
    {
        $this->db = BaseStore::GetDB();
    }

    /**
     * @param $email
     * @param $password
     * @return Employee|null
     */
    public function GetEmployee($email,$password){

        try{

            $password = md5(COOKIE_KEY.$password);

            $query = $this->db->prepare(self::SELECT_EMPLOYEE);

            $query->bind_param('ss',$email,$password);
            $query->execute();
            $result = $query->get_result();
            if(!$result){
                return null;
            }
            else{

                $employee = $result->fetch_object();
                return $employee;
            }

        }
        catch(\Exception $ex){
            echo $ex->getMessage();
            return null;
        }
    }

    /**
     * @param $id_employee
     * @return Token
     */
    public function GetToken($id_employee){

        $query = $this->db->prepare(self::SELECT_TOKEN);
        $query->bind_param('i',$id_employee);
        $query->execute();
        $result = $query->get_result() or die('error at line '.__LINE__);
        if($result->num_rows < 1){
            $nowDate = new DateTime('now',new DateTimeZone(TIME_ZONE));
            $token = new TokenModel();
            $token->id_employee  = $id_employee;
            $token->created_date = $nowDate->format(DATE_TIME_FORMAT);
            $token->token = md5($id_employee.$token->created_date);

            $query = $this->db->prepare(self::INSERT_TOKEN);
            $query->bind_param('iss',$token->id_employee,$token->token,$token->created_date);
            $query->execute() or die('Error line '.__LINE__);
            $affectedRows = $query->affected_rows;
            if($affectedRows == 1) return $token;
            else{
                die('Error on line '.__LINE__);
            }
        }
        else{
            $token = $result->fetch_object();
            return $token;
        }

    }
}