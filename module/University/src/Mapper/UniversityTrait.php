<?php

namespace University\Mapper;

/**
 * @author Fikih Firmansyah<fikihfirmansyah43@gmail.com>
 *
 * University Trait
 */
trait UniversityTrait
{
    /**
     * @var University\Mapper\University
     */
    protected $universityMapper;

    /**
     * Get UniversityMapper
     *
     * @return \University\Mapper\University
     */
    public function getUniversityMapper()
    {
        return $this->universityMapper;
    }

    /**
     * Set UniversityMapper
     *
     * @param  \University\Mapper\University $universityMapper
     */
    public function setUniversityMapper(\University\Mapper\University $universityMapper)
    {
        $this->universityMapper = $universityMapper;
    }
}
