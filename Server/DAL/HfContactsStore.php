<?php

class HfContactsStore
{
	/**
	 * @var mysqli|null
	 */
    private $db;
    function __construct()
    {
        $this->db = BaseStore::GetDB();
    }

	/**
	 * @return HfContactModel[]
	 */
	public function Select_All()
	{
		try
		{
			$lstHfContacts = array();
			$query = $this->db->prepare(self::SELECT_ALL);
			$query->execute();
			$result = $query->get_result();
			while ($row = $result->fetch_object('HfContactModel'))
			{
				array_push($lstHfContacts,$row);
			}
			return $lstHfContacts;
		}
		catch (Exception $exception)
		{
			throw $exception;
		}

	}

    /**
     * Select HfContact by ID
     * @param $id int
     * @return HfContactModel
     */
    public function Select($id)
    {
        try
        {
        	$sql = self::SELECT_ALL . ' WHERE C.id_customer = ? ';
            $query = $this->db->prepare($sql);
            $query->bind_param('i',$id);
			$query->execute();
			$result = $query->get_result();
            $row = $result->fetch_object('HfContactModel');
            return $row;
        }
        catch (Exception $exception)
        {
            throw $exception;
        }

    }


	const SELECT_ALL = "SELECT
		C.id_customer 			as ID,
        C.firstname				as `Name`,
		C.firstname   			as FirstName,
		C.lastname    			as LastName,
		'0'          			as ContactType,
		'0'          			as NationalCode,
		'0'		  				as EconomicCode,
		'0'		  	    		as RegistrationNumber,
		A.address1 				as Address,
		A.city					as City,
		A.name					as State,
		A.postcode				as PostalCode,
		A.phone					as Phone,
		'0'						as Fax,
		A.phone_mobile			as Mobile,
		C.email					as Email,
		C.website 				as Website,
		C.date_add				as RegistrationDate,
		C.note					as Note,
		'0'						as SharePercent,
		'0'						as Liability,
		'0'						as Credits,
		IFNULL(hfc.hf_code,-1)	as Code
	FROM "._DB_PREFIX_."customer C
    LEFT JOIN
	(
        SELECT a.id_address as id_address,a.id_customer,a.address1,a.postcode,a.city,a.phone,a.phone_mobile,s.`name`
            FROM   "._DB_PREFIX_."address a
            JOIN   "._DB_PREFIX_."state   s
            ON 		 a.id_state = s.id_state
            JOIN
            (
            SELECT MIN(id_address) as id_address,id_customer
                        FROM  "._DB_PREFIX_."address
                        WHERE deleted = 0
                        AND   active  = 1
                        GROUP BY id_customer
            ) i
            ON    i.id_address = a.id_address
	) A
    ON   A.id_customer = C.id_customer
    LEFT JOIN bo_hf_contacts hfc
    ON   hfc.id_customer = C.id_customer";

}