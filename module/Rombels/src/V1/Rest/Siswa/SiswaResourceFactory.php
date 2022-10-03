<?php
namespace Rombels\V1\Rest\Siswa;

class SiswaResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $siswaMapper   = $services->get(\Rombels\Mapper\Siswa::class);
        $kelasMapper   = $services->get(\Rombels\Mapper\Kelas::class);
        $siswaService  = $services->get(\Rombels\V1\Service\Siswa::class);
        $siswaResource = new SiswaResource($userProfileMapper,$siswaMapper,$kelasMapper);
        $siswaResource->setSiswaService($siswaService );
        return $siswaResource;
    }
}
