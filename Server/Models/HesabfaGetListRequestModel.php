<?php

/**
 * HesabfaGetListRequest short summary.
 *
 * HesabfaGetListRequest description.
 *
 * @version 1.0
 * @author Keyvan
 */
class HesabfaGetListRequestModel extends HesabfaBaseRequestModel
{
    public function __construct(){
        $this->queryInfo = new HesabfaQueryInfoModel();
    }

    /**
     * Summary of $Filters
     * @var HesabfaQueryInfoModel
     */
    public $queryInfo;
}
