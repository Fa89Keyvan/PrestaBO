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
    const UPDATE_TOKEN = 'UPDATE bo_tokens SET token = ?,created_date = ? WHERE id_employee = ?';

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
     * @return TokenModel
     */
    public function GetToken($id_employee){

        $token = $this->_findToken($id_employee);

        $nowDate         = Tools::GetLocalDateTime();
        $nowDateInString = Tools::DateToString($nowDate);

        if($token == null){

            $token   = new TokenModel();
            $token->id_employee  = $id_employee;
            $token->created_date = $nowDateInString;
            $token->token        = md5($id_employee.$nowDateInString);

            $this->_insertToken($token);

        }
        else{
            $tokenIntervalInSeconds = Tools::DiffInSeconds($nowDate,Tools::StringToDateTime($token->created_date));

            if($tokenIntervalInSeconds > 1200){

                $token->created_date = $nowDateInString;
                $token->token        = md5($id_employee.$nowDateInString);
                $this->_updateToken($token);
            }
        }
        return $token;
    }


    /**
     * @param $token TokenModel
     * @return TokenModel
     */
    private function _insertToken($token){

        $query = $this->db->prepare(self::INSERT_TOKEN);
        $query->bind_param('iss',$token->id_employee,$token->token,$token->created_date);
        $query->execute() or die('Error line '.__LINE__);
        $affectedRows = $query->affected_rows;
        if($affectedRows == 1) return $token;
        else{
            die('Error on line '.__LINE__);
        }

    }

    /**
     * @param $id_employee int
     * @return null|TokenModel
     */
    private function _findToken($id_employee){

        $query  = $this->db->prepare(self::SELECT_TOKEN);
        $query->bind_param('i',$id_employee);
        $query->execute();

        $result = $query->get_result() or die('error at line '.__LINE__);
        if($result->num_rows > 1) return null;

        return $result->fetch_object();
    }

    /**
     * @param $tokenModel TokenModel
     * @return bool
     */
    private function _updateToken($tokenModel){

        $query = $this->db->prepare(self::UPDATE_TOKEN);
        $query->bind_param('ssi',$tokenModel->token,$tokenModel->created_date,$tokenModel->id_employee);
        $query->execute();
        if($query->affected_rows < 1) die('Error in updating token');
        else return true;

    }
}