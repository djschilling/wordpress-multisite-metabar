<?php
/**
 * Created by IntelliJ IDEA.
 * User: david
 * Date: 16.06.16
 * Time: 20:47
 */

namespace mm;


class SiteCategory
{
    private $name;
    private $sites;

    /**
     * SiteCategory constructor.
     * @param $name
     * @param $sites
     */
    public function __construct($name, $sites)
    {
        $this->name = $name;
        $this->sites = $sites;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSites()
    {
        return $this->sites;
    }

}