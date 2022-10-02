<?php
namespace Rombels\V1\Rest\Kelas;

class KelasResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $kelasMapper   = $services->get(\Rombels\Mapper\Kelas::class);
        $kelasService  = $services->get(\Rombels\V1\Service\Kelas::class);
        $kelasResource = new KelasResource($userProfileMapper,$kelasMapper);
        $kelasResource->setKelasService($kelasService );
        return $kelasResource;
    }
}
