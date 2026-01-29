<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SessionModel;
use App\Models\ClassModel;
use App\Models\StudentModel;
use App\Models\StateModel;
use App\Models\DistrictModel;
use App\Models\StudentGurdianModel;
use App\Models\StudentAddressModel;
use App\Models\StudentPrevDetModel;
use App\Models\StudentAttendanceModel;
use App\Models\FormatNumbersModel;
use App\Models\DocumentTypeModel;
use App\Models\UserDocumentModel;

class StudentController extends BaseController
{
    protected $trustId;
    protected $schoolId;
    protected $studentModel;
    protected $classModel;
    protected $sessionModel;
    protected $stateModel;
    protected $districtModel;
    protected $studentGurdianModel;
    protected $studentAddressModel;
    protected $studentPrevDetModel;
    protected $studentAttendanceModel;
    protected $formatNumbersModel;
    protected $documentTypeModel;
    protected $userDocumentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->classModel = new classModel();
        $this->sessionModel = new SessionModel();
        $this->stateModel = new StateModel();
        $this->districtModel = new DistrictModel();
        $this->studentGurdianModel = new StudentGurdianModel();
        $this->studentAddressModel = new StudentAddressModel();
        $this->studentPrevDetModel = new StudentPrevDetModel();
        $this->studentAttendanceModel = new StudentAttendanceModel();
        $this->formatNumbersModel = new FormatNumbersModel();
        $this->documentTypeModel = new DocumentTypeModel();
        $this->userDocumentModel = new UserDocumentModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
    }

    public function form($encodedId = '')
    {
        $id = (!empty($encodedId)) ? base64url_decode($encodedId) : null;

        $details = $id
            ? $this->studentModel
            ->select('*')
            ->where('id', $id)
            ->first()
            : null;

        $data = [
            'title'      => $id ? 'Edit Student Details' : 'Add Student',
            'encodedId'  => $encodedId,
            'details'    => $details,
            'classList'  => $this->classModel
                ->where('status', 'Active')
                ->where('trust_id', $this->trustId)
                ->where('school_id', $this->schoolId)
                ->findAll(),
            'sessionList'  => $this->sessionModel
                ->where('status', 'Active')
                ->where('trust_id', $this->trustId)
                ->where('school_id', $this->schoolId)
                ->findAll(),
            'stateList'  => $this->stateModel
                ->where('status', 'Active')
                ->findAll(),
            'formatNumber' => $this->formatNumbersModel
                ->where('format_type', '1')
                ->where('trust_id', $this->trustId)
                ->where('school_id', $this->schoolId)
                ->first(),
        ];
        return view('admin/student-form', $data);
    }

    public function save()
    {
        $id = !empty($this->request->getPost('id'))
            ? $this->request->getPost('id')
            : null;

        $db = \Config\Database::connect();
        $db->transStart();


        $studentInfo = [
            'trust_id'    => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,
            'school_id'   => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'appl_no'     => !empty($this->request->getPost('appl_no')) ? $this->request->getPost('appl_no') : null,
            'name'        => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,
            'class'       => !empty($this->request->getPost('class')) ? $this->request->getPost('class') : null,
            'session'     => !empty($this->request->getPost('session')) ? $this->request->getPost('session') : null,
            'mobile'      => !empty($this->request->getPost('mobile')) ? $this->request->getPost('mobile') : null,
            'gender'      => !empty($this->request->getPost('gender')) ? $this->request->getPost('gender') : null,
            'dob'         => !empty($this->request->getPost('dob')) ? $this->request->getPost('dob') : null,
            'blood_group' => !empty($this->request->getPost('blood_group')) ? $this->request->getPost('blood_group') : null,
            'religion'    => !empty($this->request->getPost('religion')) ? $this->request->getPost('religion') : null,
            'nationality' => !empty($this->request->getPost('nationality')) ? $this->request->getPost('nationality') : null,
            'aadhar'      => !empty($this->request->getPost('aadhar')) ? $this->request->getPost('aadhar') : null,
        ];

        if ($id) {
            $this->studentModel->update($id, $studentInfo);
            $studentId = $id;
        } else {
            $studentId = $this->studentModel->insert($studentInfo);
        }

        if (!$studentId) {
            $db->transRollback();
            return redirect()->back()
                ->with('errors', $this->studentModel->errors())
                ->withInput();
        }

        $guardianData = [
            'student_id'   => $studentId,
            'f_name'  => !empty($this->request->getPost('f_name')) ? $this->request->getPost('f_name') : null,
            'm_name'  => !empty($this->request->getPost('m_name')) ? $this->request->getPost('m_name') : null,
            'f_mobile'     => !empty($this->request->getPost('f_mobile')) ? $this->request->getPost('f_mobile') : null,
            'm_mobile'     => !empty($this->request->getPost('m_mobile')) ? $this->request->getPost('m_mobile') : null,
            'f_occupation' => !empty($this->request->getPost('f_occupation')) ? $this->request->getPost('f_occupation') : null,
            'm_occupation' => !empty($this->request->getPost('m_occupation')) ? $this->request->getPost('m_occupation') : null,
            'f_income'     => !empty($this->request->getPost('f_income')) ? $this->request->getPost('f_income') : null,
            'm_income'     => !empty($this->request->getPost('m_income')) ? $this->request->getPost('m_income') : null,
        ];

        $guardian = $this->studentGurdianModel
            ->where('student_id', $studentId)
            ->first();

        if ($guardian) {
            $this->studentGurdianModel->update($guardian['id'], $guardianData);
        } else {
            $this->studentGurdianModel->insert($guardianData);
        }

        $addressData = [
            'student_id' => $studentId,
            'present_address'  => !empty($this->request->getPost('present_address')) ? $this->request->getPost('present_address') : null,
            'present_state'    => !empty($this->request->getPost('present_state')) ? $this->request->getPost('present_state') : null,
            'present_district' => !empty($this->request->getPost('present_district')) ? $this->request->getPost('present_district') : null,
            'present_city'     => !empty($this->request->getPost('present_village')) ? $this->request->getPost('present_village') : null,
            'present_po'       => !empty($this->request->getPost('present_po')) ? $this->request->getPost('present_po') : null,
            'present_pincode'  => !empty($this->request->getPost('present_pincode')) ? $this->request->getPost('present_pincode') : null,
            'present_ps'  => !empty($this->request->getPost('present_ps')) ? $this->request->getPost('present_ps') : null,
            'permanent_address'  => !empty($this->request->getPost('permanent_address')) ? $this->request->getPost('permanent_address') : null,
            'permanent_state'    => !empty($this->request->getPost('permanent_state')) ? $this->request->getPost('permanent_state') : null,
            'permanent_district' => !empty($this->request->getPost('permanent_district')) ? $this->request->getPost('permanent_district') : null,
            'permanent_city'     => !empty($this->request->getPost('permanent_village')) ? $this->request->getPost('permanent_village') : null,
            'permanent_po'       => !empty($this->request->getPost('permanent_po')) ? $this->request->getPost('permanent_po') : null,
            'permanent_pincode'  => !empty($this->request->getPost('permanent_pincode')) ? $this->request->getPost('permanent_pincode') : null,
            'permanent_ps'  => !empty($this->request->getPost('permanent_ps')) ? $this->request->getPost('permanent_ps') : null,
        ];

        $address = $this->studentAddressModel
            ->where('student_id', $studentId)
            ->first();

        if ($address) {
            $this->studentAddressModel->update($address['id'], $addressData);
        } else {
            $this->studentAddressModel->insert($addressData);
        }

        $studentPrevData = [
            'student_id' => $studentId,
            'prev_school_name'  => !empty($this->request->getPost('prev_school_name')) ? $this->request->getPost('prev_school_name') : null,
            'prev_class'    => !empty($this->request->getPost('prev_class')) ? $this->request->getPost('prev_class') : null,
            'prev_board' => !empty($this->request->getPost('prev_board')) ? $this->request->getPost('prev_board') : null,
            'prev_passing_year'     => !empty($this->request->getPost('prev_passing_year')) ? $this->request->getPost('prev_passing_year') : null,
        ];

        $prev_data = $this->studentPrevDetModel
            ->where('student_id', $studentId)
            ->first();

        if ($prev_data) {
            $this->studentPrevDetModel->update($prev_data['id'], $studentPrevData);
        } else {
            $this->studentPrevDetModel->insert($studentPrevData);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->with('error', 'Database transaction failed')
                ->withInput();
        }

        $format_type = $this->request->getPost('format_type');

        $this->formatNumbersModel
            ->where('format_type', $format_type)
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->set('format_number', 'format_number + 1', false)
            ->update();

        return redirect()->to('/admin/update-documents/' . base64_encode($studentId))
            ->with('success', $id ? 'Updated successfully!' : 'Added successfully!');
    }

    public function studentList()
    {
        $limit = PER_PAGE;

        $allStudents = $this->studentModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Students',
            'lists'         => $allStudents,
            'pager'         => $this->studentModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/student-list', $data);
    }

    public function updateDocuments($encodedId = '')
    {
        $studentId = !empty($encodedId) ? base64url_decode($encodedId) : null;
        if (empty($studentId)) {
            return redirect()->back()->with('error', 'Invalid student');
        }
        $limit = PER_PAGE;
        $details = $this->documentTypeModel
            ->select([
                'doc_type.id',
                'doc_type.doc_name',
                'doc_type.no_reqd',
                'doc_type.file_front_reqd',
                'doc_type.file_back_reqd',
                'doc_type.doc_char',
                'doc_type.file_type',
                'doc_type.doc_size',
                'doc_type.status as doc_status',
                'user_docs.id as user_doc_id',
                'user_docs.doc_no',
                'user_docs.doc_front',
                'user_docs.doc_back',
                'user_docs.status as user_doc_status',
                'user_docs.remarks',
            ])
            ->join(
                'user_docs',
                "user_docs.doc_id = doc_type.id 
             AND user_docs.student_id = {$studentId}
             AND user_docs.user_type = 'Student'",
                'left'
            )
            ->where('doc_type.status', 'Active')
            ->paginate($limit);

        $data = [
            'title'     => 'Update Documents',
            'encodedId' => $encodedId,
            'studentId' => $studentId,
            'details'   => $details,
            'pager'     => $this->documentTypeModel->pager,
            'limit'     => $limit,
        ];

        return view('admin/documents-form', $data);
    }

    public function saveDocuments()
    {
        $request = $this->request;

        $docId     = $request->getPost('doc_id');
        $studentId    = $request->getPost('student_id');
        $userType  = $request->getPost('user_type');
        $docNo     = $request->getPost('doc_no');

        if (empty($docId) || empty($studentId)) {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $uploadPath = FCPATH . 'uploads/user_docs/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $existing = $this->userDocumentModel
            ->where([
                'doc_id'    => $docId,
                'student_id'   => $studentId,
                'user_type' => $userType,
            ])
            ->first();

        $data = [
            'doc_id'    => $docId,
            'student_id'   => $studentId,
            'user_type' => $userType,
            'doc_no'    => $docNo,
            'status'    => 'Approved',
        ];

        $frontFile = $request->getFile('doc_front');

        if ($frontFile && $frontFile->isValid() && !$frontFile->hasMoved()) {
            $frontName = 'F_' . $frontFile->getRandomName();

            if ($frontFile->move($uploadPath, $frontName)) {
                if (
                    !empty($existing['doc_front']) &&
                    file_exists($uploadPath . $existing['doc_front'])
                ) {
                    unlink($uploadPath . $existing['doc_front']);
                }
                $data['doc_front'] = $frontName;
            } else {
                return redirect()->back()
                    ->with('error', $frontFile->getErrorString())
                    ->withInput();
            }
        }

        $backFile = $request->getFile('doc_back');

        if ($backFile && $backFile->isValid() && !$backFile->hasMoved()) {
            $backName = 'B_' . $backFile->getRandomName();

            if ($backFile->move($uploadPath, $backName)) {
                if (
                    !empty($existing['doc_back']) &&
                    file_exists($uploadPath . $existing['doc_back'])
                ) {
                    unlink($uploadPath . $existing['doc_back']);
                }
                $data['doc_back'] = $backName;
            } else {
                return redirect()->back()
                    ->with('error', $backFile->getErrorString())
                    ->withInput();
            }
        }

        if ($existing) {
            $this->userDocumentModel->update($existing['id'], $data);
        } else {
            $this->userDocumentModel->insert($data);
        }

        return redirect()->back()->with('success', 'Document uploaded successfully');
    }

    public function markAttendance()
    {
        $data = [
            'title'      => 'Mark Student Attendance',
            'classList'  => $this->classModel
                ->where('status', 'Active')
                ->where('trust_id', $this->trustId)
                ->where('school_id', $this->schoolId)
                ->findAll(),
            'sessionList'  => $this->sessionModel
                ->where('status', 'Active')
                ->where('trust_id', $this->trustId)
                ->where('school_id', $this->schoolId)
                ->findAll(),

        ];
        return view('admin/student-attendance', $data);
    }

    public function saveAttendance()
    {
        $sessionId = $this->request->getPost('session');
        $classId   = $this->request->getPost('class');
        $sectionId = $this->request->getPost('section');
        $attendance = $this->request->getPost('attendance');
        $trust_id      = !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null;
        $school_id    = !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null;
        $date  = $this->request->getPost('date');

        if (empty($attendance) || !is_array($attendance)) {
            return redirect()->back()->with('error', 'No attendance data found');
        }

        foreach ($attendance as $studentId => $status) {

            $this->studentAttendanceModel->insert([
                'student'        => $studentId,
                'session'        => $sessionId,
                'class'          => $classId,
                'section'        => $sectionId,
                'attendance' => $status,
                'date'   => $date,
                'trust_id'   => $trust_id,
                'school_id'   => $school_id,
            ]);
        }

        return redirect()->back()->with('success', 'Attendance Saved Successfully');
    }
}
