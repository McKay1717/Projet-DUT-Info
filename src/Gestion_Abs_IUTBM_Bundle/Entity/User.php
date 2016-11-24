<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var string
     */
    private $uid;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set uid
     *
     * @param string $uid
     *
     * @return User
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

