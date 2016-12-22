<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Abscence
 *
 * @ORM\Table(name="Abscence", indexes={@ORM\Index(name="fk_Abscence_User", columns={"user_id"})})
 * @ORM\Entity
 * @Vich\Uploadable
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
     * @var String
     *
     * @ORM\Column(name="fich_justificatif", type="string", length=255, nullable=false)
     */
    private $fichJustificatif;

    /**
     * @var File
     *
     *  @Vich\UploadableField(mapping="product_image", fileNameProperty="fichJustificatif")
     */
    private $fileFichJustificatif;

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

    public function __construct() {
        $this->debutAbs = new \DateTime();
        $this->finAbs = new \DateTime();
    }

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
     * @param File $fileFichJustificatif
     *
     * @return Abscence
     */
    public function setFileFichJustificatif(File $fileFichJustificatif)
    {
        $this->fileFichJustificatif = $fileFichJustificatif;
        return $this;
    }

    /**
     * @return File
     */
    public function getFileFichJustificatif()
    {
        return $this->fileFichJustificatif;
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
