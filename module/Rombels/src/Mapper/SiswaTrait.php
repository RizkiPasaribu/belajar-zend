<?php

namespace Rombels\Mapper;

/**
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 *
 * Rombels Trait
 */
trait SiswaTrait
{
    /**
     * @var Rombels\Mapper\Siswa
     */
    protected $siswaMapper;

    /**
     * Get RombelsMapper
     *
     * @return \Rombels\Mapper\Rombels
     */
    public function getSiswaMapper()
    {
        return $this->siswaMapper;
    }

    /**
     * Set RombelsMapper
     *
     * @param  \Rombels\Mapper\Rombels $siswaMapper
     */
    public function setSiswaMapper(\Rombels\Mapper\Siswa $siswaMapper)
    {
        $this->siswaMapper = $siswaMapper;
    }
}
