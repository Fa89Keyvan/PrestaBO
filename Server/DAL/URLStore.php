<?php

/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/19/2018
 * Time: 8:17 PM
 */
class URLStore
{

    /**
     * @var mysqli|null
     */
    private $db;
    function __construct()
    {
        $this->db = BaseStore::GetDB();
    }

    const SELECT_URL     = 'SELECT * FROM bo_url';
    const INSERT_URL     = 'INSERT INTO bo_url(id_url,url) VALUES(?,?)';
    const IS_EXISTS_URL  = 'SELECT EXISTS(SELECT 1  FROM bo_url WHERE id_url = ?) as `is_exists`';


    /**
     * @return URLModel[]
     */
    public function SelectURLs(){
        try{

            $lstURLs = array();
            $query = $this->db->prepare(self::SELECT_URL);
            $query->execute();
            $result = $query->get_result();
            while($url = $result->fetch_object('URLModel'))
                array_push($lstURLs,$url);

            return $lstURLs;

        }
        catch(Exception $ex){
            //log $ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }

    /**
     * @param $url URLModel
     * @return URLModel
     */
    public function InsertUrl($url){
        try{

            $query = $this->db->prepare(self::INSERT_URL);
            $query->bind_param('is',$url->id_url,$url->url);
            $query->execute();
            if($query->affected_rows < 1)
                die(sprintf('can not insert record with id_url: %i and url: %s',$url->id_url,$url->url));

            return $url;

        }
        catch(Exception $ex){
            //log ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }

    /**
     * @param $id_url int
     * @return bool
     */
    public function IsExists($id_url){
        try{

            $query = $this->db->prepare(self::IS_EXISTS_URL);
            $query->bind_param('i',$id_url);
            $query->execute();
            $result = $query->get_result();
            if($result === false)
                return false;

            $rec = $result->fetch_assoc();
            if($rec['is_exists'] == 1)
                return true;

            return false;

        }
        catch(Exception $ex){
            //log ex;
            die($ex->getMessage().' '.$ex->getTrace().' Line:'.$ex->getLine());
        }
    }
}