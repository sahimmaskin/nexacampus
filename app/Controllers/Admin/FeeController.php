<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TrustModel;
use App\Models\SchoolModel;
use App\Models\FeeParticularModel;
use App\Models\SessionModel;
use App\Models\ClassModel;

class FeeController extends BaseController
{
    protected $trustId;
    protected $schoolId;
    protected $trustModel;
    protected $schoolModel;
    protected $feeParticularModel;
    protected $sessionModel;
    protected $classModel;
    public function __construct()
    {
        $this->trustModel = new TrustModel();
        $this->schoolModel = new SchoolModel();
        $this->feeParticularModel = new FeeParticularModel();
        $this->classModel = new ClassModel();
        $this->sessionModel = new SessionModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
        helper(['form', 'url', 'custom']);
    }

    public function particularsList()
    {
        $limit = PER_PAGE;

        $allFeeParticulars = $this->feeParticularModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Fee Particulars',
            'lists'         => $allFeeParticulars,
            'pager'         => $this->feeParticularModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/particular-list', $data);
    }

    public function saveParticulars()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'trust_id' => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,
            'school_id' => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'name' => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,
            'collected' => !empty($this->request->getPost('collected')) ? $this->request->getPost('collected') : null,
        ];

        if ($id) {
            $this->feeParticularModel->update($id, $formData);
            $lastID = $id;
        } else {
            $lastID = $this->feeParticularModel->insert($formData);
        }

        return redirect('admin/fee-particulars')->with(
            'success',
            $id ? 'Updated successfully' : 'Added successfully'
        );
    }

    public function feeSetUp()
    {
        $allSessions = $this->sessionModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->findAll();
        $allClasses = $this->classModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->findAll();
        $feeParticulars = $this->feeParticularModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->findAll();

        $data = [
            'title'         => 'Setup Fee by Class',
            'sessionList'         => $allSessions,
            'classList' => $allClasses,
            'feeParticularList' => $feeParticulars
        ];

        return view('admin/fee-setup', $data);
    }

    public function saveFee()
    {
        print_r($_POST);
        exit;
    }
}
