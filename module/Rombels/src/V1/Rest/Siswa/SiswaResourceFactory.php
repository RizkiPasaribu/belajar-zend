<?php
namespace Rombels\V1\Rest\Siswa;

class SiswaResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $siswaMapper   = $services->get(\Rombels\Mapper\Siswa::class);
        // $userAccessMapper   = $services->get(\User\Mapper\UserAccess::class);
        // $siswaService  = $services->get(\Rombels\V1\Service\Siswa::class);
        return new SiswaResource(
            // $qRCodeMapper, 
            $userProfileMapper,
            $siswaMapper
            // $userAccessMapper
        );
        // $siswaResource->siswaService($siswaResource);
        // return $siswaResource;
        // return new SiswaResource();
    }
}
