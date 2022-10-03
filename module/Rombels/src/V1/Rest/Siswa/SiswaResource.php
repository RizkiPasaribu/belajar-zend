<?php
namespace Rombels\V1\Rest\Siswa;

use Rombels\Mapper\KelasTrait;
use Zend\Paginator\Paginator;
use User\Mapper\UserProfileTrait;
use Rombels\Mapper\SiswaTrait;
use User\V1\Rest\AbstractResource;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class SiswaResource extends AbstractResource
{
    protected $siswaService;

    use UserProfileTrait;
    use SiswaTrait;
    use KelasTrait;
    public function __construct($userProfileMapper,$siswaMapper,$kelasMapper)
    {
        $this->setUserProfileMapper($userProfileMapper);
        $this->setSiswaMapper($siswaMapper);
        $this->setKelasMapper($kelasMapper);
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {

        $userProfile = $this->fetchUserProfile();
        if (is_null($userProfile)) {
            return new ApiProblemResponse(new ApiProblem(403, "You do not have access!"));
        }

        $data = (array) $data;
        $inputFilter = $this->getInputFilter();
        $kelasSlug = $data['kelas_uuid'];
        try {
            // cek keleas uuid yang diset klw ada 
            // tetapi tidak ada di tabel relasi aku gagal kan
            if (isset($kelasSlug) && $kelasSlug != "") {
                $kelasEntity = $this->getKelasMapper()->fetchOneBy([
                    "uuid" => $kelasSlug
                ]);
                if (empty($kelasEntity)) return new ApiProblemResponse(new ApiProblem(404, "Tabel Not Found!!"));
            } 
            
            $inputFilter->add(['name' => 'kelas']);    
            $inputFilter->get('kelas')->setValue($kelasSlug);

            $inputFilter->add(['name' => 'createdAt']);
            $inputFilter->get('createdAt')->setValue(new \DateTime('now'));

            $inputFilter->add(['name' => 'updatedAt']);
            $inputFilter->get('updatedAt')->setValue(new \DateTime('now'));
            
            $result = $this->siswaService->addSiswa($inputFilter);
            return $result;
        } catch (\User\V1\Service\Exception\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $userProfile = $this->fetchUserProfile();
        if (is_null($userProfile) || is_null($userProfile->getAccount())) {
            return new ApiProblemResponse(new ApiProblem(404, "You do not have access"));
        }
        
        try {
            $kelas = $this->getSiswaMapper()->fetchOneBy(['uuid' => $id]);
            if (is_null($kelas)) {
                return new ApiProblem(404, "Kelas data Not Found");
            }
            $this->getSiswaService()->deleteSiswa($kelas);
            return new ApiProblem(200, "Succes Deleted Siswa With UUID ".$id,null,"Success");
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $siswa = $this->siswaMapper->fetchOne($id);
        if(!$siswa) return new ApiProblemResponse(new ApiProblem(404,'School Not Found'));
        return $siswa;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $userProfile = $this->fetchUserProfile();
        if(is_null($userProfile)) return new ApiProblemResponse(new ApiProblem(401,'You\'re Not Authorized'));
        $urlParams = [];

        $qb = $this->siswaMapper->fetchAll($urlParams);
        $paginatorAdapter =$this->siswaMapper->createPaginatorAdapter($qb);
        return new Paginator($paginatorAdapter);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        $siswa = $this->getSiswaMapper()->fetchOneBy(['uuid'=>$id]);
        if (is_null($siswa)) {
            return new ApiProblemResponse(new ApiProblem(404, "Siswa data not found!"));
        }
        $inputFilter = $this->getInputFilter();
        $this->getSiswaService()->editSiswa($siswa, $inputFilter);
        return $siswa;
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }


    // add services
    public function setSiswaService($siswaService)
    {
        $this->siswaService = $siswaService;

        return $this;
    }

    public function getSiswaService()
    {
        return $this->siswaService;
    }
}
