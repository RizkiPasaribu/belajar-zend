<?php

namespace University\V1\Rest\University;

class UniversityResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $universityMapper   = $services->get(\University\Mapper\University::class);
        $universityService  = $services->get(\University\V1\Service\University::class);
        $universityResource = new UniversityResource(
            $universityMapper,
            $userProfileMapper
        );
        $universityResource->setUniversityService($universityService);
        return $universityResource;
    }
}
