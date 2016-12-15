<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abscence
 *
 * @ORM\Table(name="Abscence", indexes={@ORM\Index(name="fk_Abscence_User", columns={"user_id"})})
 * @ORM\Entity
 */
class Abscence
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_abs", type="datetime", nullable=false)
     */
    private $debutAbs = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="fich_justificatif", type="string", length=255, nullable=false)
     */
    private $fichJustificatif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_abs", type="datetime", nullable=true)
     */
    private $finAbs;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Gestion_Abs_IUTBM_Bundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Gestion_Abs_IUTBM_Bundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
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
