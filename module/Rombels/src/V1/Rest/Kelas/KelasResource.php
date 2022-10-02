<?php
namespace Rombels\V1\Rest\Kelas;

use Amp\Success;
use Rombels\Mapper\KelasTrait;
use User\Mapper\UserProfileTrait;
use User\V1\Rest\AbstractResource;
use Zend\Paginator\Paginator;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

class KelasResource extends AbstractResource
{
    protected $kelasService;
    use KelasTrait;
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function __construct($userProfileMapper,$kelasMapper)
    {
        $this->setUserProfileMapper($userProfileMapper);
        $this->setKelasMapper($kelasMapper);
    }

    public function create($data)
    {
        $userProfile = $this->fetchUserProfile();
        if (is_null($userProfile)) {
            return new ApiProblemResponse(new ApiProblem(403, "You do not have access!"));
        }

        $data = (array) $data;
        $inputFilter = $this->getInputFilter();
        try {

            $inputFilter->add(['name' => 'createdAt']);
            $inputFilter->get('createdAt')->setValue(new \DateTime('now'));

            $inputFilter->add(['name' => 'updatedAt']);
            $inputFilter->get('updatedAt')->setValue(new \DateTime('now'));

            $result = $this->kelasService->addKelas($inputFilter);
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
        //cek authorization
        $userProfile = $this->fetchUserProfile();
        if (is_null($userProfile) || is_null($userProfile->getAccount())) {
            return new ApiProblemResponse(new ApiProblem(404, "You do not have access"));
        }
        
        try {
            $kelas = $this->getKelasMapper()->fetchOneBy(['uuid' => $id]);
            if (is_null($kelas)) {
                return new ApiProblem(404, "Kelas data Not Found");
            }
            $this->getKelasService()->deleteKelas($kelas);
            return new ApiProblem(200, "Succes Deleted uuid".$id,null,"Success");
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }
        // return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
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
        $kelas = $this->kelasMapper->fetchOne($id);
        if(!$kelas) return new ApiProblemResponse(new ApiProblem(404,'School Not Found'));
        return $kelas;
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

        $qb = $this->kelasMapper->fetchAll($urlParams);
        $paginatorAdapter =$this->kelasMapper->createPaginatorAdapter($qb);
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
        $kelas = $this->getKelasMapper()->fetchOneBy(['uuid' => $id]);
        if (is_null($kelas)) {
            return new ApiProblemResponse(new ApiProblem(404, "Kelas data not found!"));
        }
        $inputFilter = $this->getInputFilter();

        $this->getKelasService()->editKelas($kelas, $inputFilter);
        return $kelas;
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
    public function setKelasService($kelasService)
    {
        $this->kelasService = $kelasService;

        return $this;
    }

    public function getKelasService()
    {
        return $this->kelasService;
    }
}
