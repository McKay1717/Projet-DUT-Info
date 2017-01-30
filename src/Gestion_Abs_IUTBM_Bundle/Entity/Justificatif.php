<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Justificatif
 *
 * @ORM\Table(name="justificatif")
 * @ORM\Entity(repositoryClass="Gestion_Abs_IUTBM_Bundle\Repository\JustificatifRepository")
 * @Vich\Uploadable
 */
class Justificatif
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_abs", type="datetime")
     */
    private $debutAbs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin_abs", type="datetime")
     */
    private $finAbs;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier_name", type="string", length=255)
     */
    private $fichierName;

    /**
     * @var File
     *
     *  @Vich\UploadableField(mapping="product_image", fileNameProperty="fichier_name")
     */
    private $fichier;

    /**
     * Get id
     *
     * @return int
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
     * @return Justificatif
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
     * @return Justificatif
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
     * Set fichierName
     *
     * @param string $fichierName
     *
     * @return Justificatif
     */
    public function setFichierName($fichierName)
    {
        $this->fichierName = $fichierName;

        return $this;
    }

    /**
     * Get fichierName
     *
     * @return string
     */
    public function getFichierName()
    {
        return $this->fichierName;
    }

    /**
     * @param File $fichier
     *
     * @return Justificatif
     */
    public function setFichier(File $fichier)
    {
        $this->fichier = $fichier;
        return $this;
    }

    /**
     * @return File
     */
    public function getFichier()
    {
        return $this->fichier;
    }

}

