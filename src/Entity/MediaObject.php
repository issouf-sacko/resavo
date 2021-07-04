<?php

namespace App\Entity;

use App\Repository\MediaObjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=MediaObjectRepository::class)
 * @Vich\Uploadable
 */
class MediaObject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @Vich\UploadableField(mapping="media_images", fileNameProperty="fileName")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface  $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="room", inversedBy="mediaObjects")
     */
    private $room;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->fileName;
    }

    public function setFilename(string $filename): self
    {
        $this->fileName = $filename;

        return $this;
    }

    public function getRoom(): ?room
    {
        return $this->room;
    }

    public function setRoom(?room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @param mixed $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new DateTime();
            
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
