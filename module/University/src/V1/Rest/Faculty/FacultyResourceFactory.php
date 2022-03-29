<?php
namespace University\V1\Rest\Faculty;

class FacultyResourceFactory
{
    public function __invoke($services)
    {
        return new FacultyResource();
    }
}
