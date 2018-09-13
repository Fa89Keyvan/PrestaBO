<?php

/**
 * HesabfaQueryInfo short summary.
 *
 * HesabfaQueryInfo description.
 *
 * @version 1.0
 * @author Keyvan
 */
class HesabfaQueryInfoModel
{
    /**
     * Summary of $SortBy
     * @var string
     */
    public $SortBy; //String

    /**
     * Summary of $SortDesc
     * @var boolean
     */
    public $SortDesc; //boolean

    /**
     * Summary of $Take
     * @var int
     */
    public $Take; //int

    /**
     * Summary of $Take
     * @var int
     */
    public $Skip; //int

    /**
     * Summary of $Filters
     * @var HesabfaFilterModel[]
     */
    public $Filters;
}