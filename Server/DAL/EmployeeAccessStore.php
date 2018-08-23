<?php


class EmployeeAccessStore
{
    /**
     * @var mysqli|null
     */
    private $db;
    function __construct()
    {
        $this->db = BaseStore::GetDB();
    }


    const SELECT_EMPLOYEE_ACCESS_URL =
        'SELECT a.id_employee,u.url,u.text,u.menu,u.api
            FROM 	 bo_employee_access   a
            JOIN     bo_url				  u
            ON		 a.id_url = u.id_url
            WHERE    a.id_employee = ?
            AND      u.api = ?';

    const INSERT_EMPLOYEE_ACCESS = 'INSERT INTO bo_employee_access(id_employee,id_url) values(?,?)';

    const DELETE_EMPLOYEE_ACCESS = 'DELETE FROM bo_employee_access WHERE id_employee_access = ?';

    const DELETE_EMPLOYEE_ACCESS_BY_EMP_ID = 'DELETE FROM bo_employee_access WHERE id_employee = ?';

    const HAS_ACCESS =
        'SELECT EXISTS
        (
            SELECT 1
                FROM	bo_employee_access   a
                JOIN  bo_url u
                ON    a.id_url = u.id_url
                WHERE a.id_employee = ?
                AND   u.url = ?
        ) AS `hasAccess`';


    /**
     * @param $employeeAccesses EmployeeAccessModel[]
     * @return EmployeeAccessModel[]
     */
    public function InsertEmployeeAccess($employeeAccesses){
        try{

            $arrayLength = count($employeeAccesses);
            for ($i = 0; $i <= $arrayLength; $i++)
            {
                $query = $this->db->prepare(self::INSERT_EMPLOYEE_ACCESS);
                $query->bind_param('ii',$employeeAccesses[i]->id_employee,$employeeAccesses[i]->id_url);
                $query->execute();
                if($query->affected_rows < 1)
                    die(sprintf('can not insert record with id_employee: %s and id_url: %s',$employeeAccesses[i]->id_employee,$employeeAccesses[i]->id_url));
                $employeeAccesses[i]->id_employee_access = $query->insert_id;
            }

            return $employeeAccesses;

        }
        catch(Exception $ex){
            //log ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }


    /**
     * @param $employeeAccess EmployeeAccessModel
     * @return bool
     */
    public function DeleteEmployeeAccess($employeeAccess){
        try{

            $query = $this->db->prepare(self::DELETE_EMPLOYEE_ACCESS);
            $query->bind_param('i',$employeeAccess->id_employee_access);
            $query->execute();
            if($query->affected_rows < 1)
                return false;
            return true;

        }
        catch(Exception $ex){
            //log $ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }


    /**
     * @param $id_employee int
     * @return bool
     */
    public function DeleteEmployeeAccessByEmpId($id_employee){
        try{

            $query = $this->db->prepare(self::DELETE_EMPLOYEE_ACCESS_BY_EMP_ID);
            $query->bind_param('i',$id_employee);
            $query->execute();
            if($query->affected_rows < 1)
                return false;
            return true;

        }
        catch(Exception $ex){
            //log $ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }

    /**
     * @param $employeeId int
     * @param $api int = 0
     * @return EmployeeAccessUrlModel[]
     * @throws Exception
     */
    public function SelectEmployeeUrls($employeeId,$api = 0){

        try{

            $lstEmployeeUrls = array();
            $query = $this->db->prepare(self::SELECT_EMPLOYEE_ACCESS_URL);
            $query->bind_param('ii',$employeeId,$api);
            $query->execute();
            $result = $query->get_result();

            while($empUrl = $result->fetch_object('EmployeeAccessUrlModel')){
                array_push($lstEmployeeUrls,$empUrl);
            }
            return $lstEmployeeUrls;

        }
        catch(Exception $ex){
            throw $ex;
        }

    }


    /**
     * @param $employeeId int
     * @param $url string
     * @return bool
     * @throws Exception
     */
    public function HasAccess($employeeId,$url){
        try{

            $query = $this->db->prepare(self::HAS_ACCESS);
            $query->bind_param('is',$employeeId,$url);
            $query->execute();
            $result = $query->get_result();

            $record = $result->fetch_assoc();

            if($record['hasAccess'] == 1)
                return true;

            return false;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }



}