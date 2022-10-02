<?php

namespace Rombels\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Siswa
 */
class Siswa implements EntityInterface
{
    /**
     * @var string|null
     */
    private $nama;

    /**
     * @var string|null
     */
    private $nim;

    private $photo;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     */
    private $deletedAt;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var \Rombels\Entity\Kelas
     */
    private $kelas;



    /**
     * Set nama.
     *
     * @param string|null $nama
     *
     * @return Siswa
     */
    public function setNama($nama = null)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama.
     *
     * @return string|null
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set nim.
     *
     * @param string|null $nim
     *
     * @return Siswa
     */
    public function setNim($nim = null)
    {
        $this->nim = $nim;

        return $this;
    }

    /**
     * Get nim.
     *
     * @return string|null
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get nim.
     *
     * @return string|null
     */
    public function getNim()
    {
        return $this->nim;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Siswa
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return Siswa
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return Siswa
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set kelas.
     *
     * @param \Rombels\Entity\Kelas|null $kelas
     *
     * @return Siswa
     */
    public function setKelas(\Rombels\Entity\Kelas $kelas = null)
    {
        $this->kelas = $kelas;

        return $this;
    }

    /**
     * Get kelas.
     *
     * @return \Rombels\Entity\Kelas|null
     */
    public function getKelas()
    {
        return $this->kelas;
    }
}
