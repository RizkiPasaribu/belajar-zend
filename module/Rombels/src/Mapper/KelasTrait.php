<?php

namespace Rombels\Mapper;

/**
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 *
 * Rombels Trait
 */
trait KelasTrait
{
    /**
     * @var Rombels\Mapper\Kelas
     */
    protected $kelasMapper;

    /**
     * Get RombelsMapper
     *
     * @return \Rombels\Mapper\Rombels
     */
    public function getKelasMapper()
    {
        return $this->kelasMapper;
    }

    /**
     * Set RombelsMapper
     *
     * @param  \Rombels\Mapper\Rombels $kelasMapper
     */
    public function setKelasMapper(\Rombels\Mapper\Kelas $kelasMapper)
    {
        $this->kelasMapper = $kelasMapper;
    }
}
