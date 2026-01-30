<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PeriodModel;

class PeriodController extends BaseController
{
   
     public function __construct()
    {
        $this->periodModel = new PeriodModel();
        // $this->classModel = new classModel();
        // $this->sectionModel = new SectionModel();
        // $this->subjectModel = new SubjectModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
    }

    public function periodPage()
    {
        $limit = PER_PAGE;
      
        $allPeriods = $this->periodModel
            ->where('school_id', $this->schoolId)
            ->paginate($limit);
       
        $data = [
            'title'         => 'Periods',
            'lists'         => $allPeriods,
            'pager'         => $this->periodModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/timetables/periods', $data);
    }

    public function savePeriod()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [

            'school_id' => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'start_time' => !empty($this->request->getPost('start_time')) ? $this->request->getPost('start_time') : null,
            'end_time'  => !empty($this->request->getPost('end_time')) ? $this->request->getPost('end_time') : null,
        ];

        if ($id) {
            $this->periodModel->update($id, $formData);
            $lastID = $id;
        } else {
            $lastID = $this->periodModel->insert($formData);
        }

        return redirect('periodPage')->with(
            'success',
            $id ? 'Period updated successfully' : 'Period added successfully'
        );
    }

    public function deletePeriod($id)
{
    if (!$id) {
        return redirect()->back()->with('error', 'Invalid Period ID');
    }

    $period = $this->periodModel->find($id);

    if (!$period) {
        return redirect()->back()->with('error', 'Period not found');
    }

    $this->periodModel->delete($id);

    return redirect()->back()->with('success', 'Period deleted successfully');
}


   
}
