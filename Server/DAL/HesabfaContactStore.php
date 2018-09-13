<?php

/**
 * HesabfaContactStore short summary.
 *
 * HesabfaContactStore description.
 *
 * @version 1.0
 * @author Keyvan
 */
class HesabfaContactStore extends HesabfaBaseStore
{
    const CONTACT_GET = 'contact/get';
    const CONTACTS_GET = 'contact/getcontacts';

    /**
     * Summary of _getContacts
     * @param HesabfaGetListRequestModel $hfListRequest
     * @return HesabfaBaseResponseModel
     */
    private function _getContacts($hfListRequest){
        $url = $this->CreateUrl(self::CONTACTS_GET);
        //echo Tools::ToJson($hfListRequest);
        //die();
        $result = Tools::PostAsJson($url,$hfListRequest);
        return Tools::FromJson($result);
    }


    /**
     * Summary of GetContactsByMobile
     * @param string $mobile 
     * @param int $take 
     * @param int $skip
     * @return HesabfaBaseResponseModel
     */
    public function GetContactsByMobile($mobile,$take = 500000,$skip = 0){
        
        $filters = array();
        $filter = new HesabfaFilterModel();
        $filter->Operator = HesabfaFilterModel::CONTAINS;
        $filter->Property = 'Mobile';
        $filter->Value = $mobile;
        array_push($filters,$filter);

        $request = new HesabfaGetListRequestModel();
        $request->queryInfo->Take = $take;
        $request->queryInfo->Skip = $skip;
        $request->queryInfo->Filters = $filters;

        $result = $this->_getContacts($request);

        return $result;
    }
}