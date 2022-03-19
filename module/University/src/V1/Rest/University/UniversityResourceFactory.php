<?php
namespace University\V1\Rest\University;

class UniversityResourceFactory
{
    public function __invoke($services)
    {
        return new UniversityResource();
    }
}
