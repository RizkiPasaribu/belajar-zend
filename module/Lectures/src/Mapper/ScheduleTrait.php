<?php

namespace Lectures\Mapper;

/**
 * @author Fikih Firmansyah<fikihfirmansyah43@gmail.com>
 *
 * Schedule Trait
 */
trait ScheduleTrait
{
    /**
     * @var Lectures\Mapper\Schedule
     */
    protected $scheduleMapper;

    /**
     * Get ScheduleMapper
     *
     * @return \Lectures\Mapper\Schedule
     */
    public function getScheduleMapper()
    {
        return $this->scheduleMapper;
    }

    /**
     * Set ScheduleMapper
     *
     * @param  \Lectures\Mapper\Schedule $scheduleMapper
     */
    public function setScheduleMapper(\Lectures\Mapper\Schedule $scheduleMapper)
    {
        $this->scheduleMapper = $scheduleMapper;
    }
}
