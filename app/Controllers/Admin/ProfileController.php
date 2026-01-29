<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TrustModel;
use App\Models\SchoolModel;
use App\Models\SchoolDetailsModel;

class ProfileController extends BaseController
{
    protected $trustModel;
    protected $schoolModel;
    protected $schoolDetailsModel;
    protected $trustId;
    protected $schoolId;
    public function __construct()
    {
        $this->trustModel = new TrustModel();
        $this->schoolModel = new SchoolModel();
        $this->schoolDetailsModel = new SchoolDetailsModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
        helper(['form', 'url', 'custom']);
    }

    public function myProfile(){
        $trust_details = $this->trustModel
            ->select('*')
            ->where('id', $this->trustId);

        $school_details = $this->schoolDetailsModel
            ->select('*')
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId);

        $data = [
            'title'      => 'School Details',
            'trust_details'    => $trust_details,
            'school_details'    => $school_details,
        ];
        return view('admin/school-details', $data);
    }
}
