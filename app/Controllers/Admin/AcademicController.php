<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SessionModel;
use App\Models\ClassModel;
use App\Models\SectionModel;
use App\Models\SubjectModel;

class AcademicController extends BaseController
{
    protected $trustId;
    protected $schoolId;
    protected $sessionModel;
    protected $classModel;
    protected $sectionModel;
    protected $subjectModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->classModel = new classModel();
        $this->sectionModel = new SectionModel();
        $this->subjectModel = new SubjectModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
    }

    public function index()
    {
        $limit = PER_PAGE;

        $allSessions = $this->sessionModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Sessions',
            'lists'         => $allSessions,
            'pager'         => $this->sessionModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/session-list', $data);
    }

    public function saveSession()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'trust_id'  => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,

            'school_id' => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,

            'name'      => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,

            'start_date' => !empty($this->request->getPost('start_date')) ? $this->request->getPost('start_date') : null,

            'end_date'  => !empty($this->request->getPost('end_date')) ? $this->request->getPost('end_date') : null,
        ];

        if ($id) {
            $this->sessionModel->update($id, $formData);
            $lastID = $id;
        } else {
            $lastID = $this->sessionModel->insert($formData);
        }

        return redirect('admin/view-session')->with(
            'success',
            $id ? 'Session updated successfully' : 'Session added successfully'
        );
    }

    public function classList()
    {
        $limit = PER_PAGE;

        $allClass = $this->classModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Sessions',
            'lists'         => $allClass,
            'pager'         => $this->classModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/class-list', $data);
    }

    public function saveClass()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'trust_id'            => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,
            'school_id'            => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'name'            => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,
        ];

        if ($id) {
            $this->classModel->update($id, $formData);
            $lastID = $id;
        } else {
            $lastID = $this->classModel->insert($formData);
        }

        return redirect('admin/view-class')->with(
            'success',
            $id ? 'Class updated successfully' : 'Class added successfully'
        );
    }

    public function sectionList()
    {
        $limit = PER_PAGE;

        $allSection = $this->sectionModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Sections',
            'lists'         => $allSection,
            'classList'    => $this->classModel->where('status', 'Active')->where('trust_id', $this->trustId)->where('school_id', $this->schoolId)->findAll(),
            'pager'         => $this->sectionModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/section-list', $data);
    }

    public function saveSection()
    {
        $id = $this->request->getPost('id');

        $formData = [
            'trust_id'         => $this->request->getPost('trust_id'),
            'school_id'        => $this->request->getPost('school_id'),
            'class_id'         => $this->request->getPost('class_id'),
            'name'             => $this->request->getPost('name'),
            'student_capacity' => $this->request->getPost('student_capacity'),
        ];

        if ($id) {
            $this->sectionModel->update($id, $formData);
            $message = 'Section updated successfully';
        } else {
            $this->sectionModel->insert($formData);
            $message = 'Section added successfully';
        }

        return redirect()->to('admin/view-section')
            ->with('success', $message);
    }

    public function subjectList()
    {
        $limit = PER_PAGE;

        $allSubjects = $this->subjectModel
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Subjects',
            'lists'         => $allSubjects,
            'pager'         => $this->subjectModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/subject-list', $data);
    }

    public function saveSubject()
    {
        $id = $this->request->getPost('id');

        $formData = [
            'trust_id'         => $this->request->getPost('trust_id'),
            'school_id'        => $this->request->getPost('school_id'),
            'name'             => $this->request->getPost('name'),
            'code' => $this->request->getPost('code'),
            'type' => $this->request->getPost('type'),
        ];

        if ($id) {
            $this->subjectModel->update($id, $formData);
            $message = 'Subject updated successfully';
        } else {
            $this->subjectModel->insert($formData);
            $message = 'Subject added successfully';
        }

        return redirect()->to('admin/view-subject')
            ->with('success', $message);
    }
}
