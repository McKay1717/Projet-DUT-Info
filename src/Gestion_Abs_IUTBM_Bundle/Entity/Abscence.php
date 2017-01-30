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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_abs", type="datetime", nullable=false)
     */
    private $debutAbs = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_abs", type="datetime", nullable=true)
     */
    private $finAbs;

    /**
     * @var Justificatif
     *
     * @ORM\ManyToOne(targetEntity="Gestion_Abs_IUTBM_Bundle\Entity\Justificatif", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $justificatif;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Gestion_Abs_IUTBM_Bundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function __construct() {
        $this->debutAbs = new \DateTime(null, new \DateTimeZone('Europe/Paris'));
        $this->finAbs = null;
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
     * Set debutAbs
     *
     * @param \DateTime $debutAbs
     *
     * @return Abscence
     */
    public function setDebutAbs(\DateTime $debutAbs)
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
     * Set justificatif
     *
     * @param Justificatif $justificatif
     *
     * @return Abscence
     */
    public function setJustificatif(Justificatif $justificatif)
    {
        $this->justificatif = $justificatif;

        return $this;
    }

    /**
     * Get justificatif
     *
     * @return Justificatif
     */
    public function getJustificatif()
    {
        return $this->justificatif;
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
     * Set user
     *
     * @param User $user
     *
     * @return Abscence
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}
