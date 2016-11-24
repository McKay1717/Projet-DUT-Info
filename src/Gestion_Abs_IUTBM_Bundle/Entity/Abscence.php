<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

/**
 * Abscence
 */
class Abscence
{
    /**
     * @var \DateTime
     */
    private $debutAbs = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $finAbs;

    /**
     * @var string
     */
    private $fichJustificatif;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Gestion_Abs_IUTBM_Bundle\Entity\User
     */
    private $user;


    /**
     * Set debutAbs
     *
     * @param \DateTime $debutAbs
     *
     * @return Abscence
     */
    public function setDebutAbs($debutAbs)
    {
        $this->debutAbs = $debutAbs;

        return $this;
    }

    /**
     * Get debutAbs
     *
     * @return \DateTime
     */
    public function getDebutAbs()
    {
        return $this->debutAbs;
    }

    /**
     * Set finAbs
     *
     * @param \DateTime $finAbs
     *
     * @return Abscence
     */
    public function setFinAbs($finAbs)
    {
        $this->finAbs = $finAbs;

        return $this;
    }

    /**
     * Get finAbs
     *
     * @return \DateTime
     */
    public function getFinAbs()
    {
        return $this->finAbs;
    }

    /**
     * Set fichJustificatif
     *
     * @param string $fichJustificatif
     *
     * @return Abscence
     */
    public function setFichJustificatif($fichJustificatif)
    {
        $this->fichJustificatif = $fichJustificatif;

        return $this;
    }

    /**
     * Get fichJustificatif
     *
     * @return string
     */
    public function getFichJustificatif()
    {
        return $this->fichJustificatif;
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

    /**
     * Set user
     *
     * @param \Gestion_Abs_IUTBM_Bundle\Entity\User $user
     *
     * @return Abscence
     */
    public function setUser(\Gestion_Abs_IUTBM_Bundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Gestion_Abs_IUTBM_Bundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

