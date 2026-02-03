<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PeriodModel;
use App\Models\SessionModel;
use App\Models\TimetableModel;
use App\Models\classModel;
use App\Models\SectionModel;
use App\Models\TimeSlotModel;
use App\Models\UserModel;

class PeriodController extends BaseController
{
   
     public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->timeTableModel = new TimetableModel();
        $this->timeSlotModel = new TimeSlotModel();
        $this->userModel = new UserModel();
        $this->periodModel = new PeriodModel();
        $this->classModel = new classModel();
        $this->sectionModel = new SectionModel();
        $this->subjectModel = new TimeSlotModel();
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


   // for timetable functions
     public function timeTablePage()
    {
        $limit = PER_PAGE;
      
      $allTimeTable = $this->timeTableModel
            ->getTimetableWithPeriod($this->schoolId)
            ->paginate($limit);
        $allClass = $this->classModel
            ->where('school_id', $this->schoolId)
            ->paginate($limit);
        $allSection = $this->sectionModel
            ->where('school_id', $this->schoolId)
            ->paginate($limit);
        $allPeriod = $this->periodModel
            ->where('school_id', $this->schoolId)
            ->paginate($limit);
       
        $data = [
            'title'         => 'Time Table',
            'lists'         => $allTimeTable,
            'pager'         => $this->timeTableModel->pager,
            'limit'         => $limit,
            'classes'   => $allClass,
            'sections'  => $allSection,
            'periods'   => $allPeriod,
        ];

        return view('admin/timetables/time_tables', $data);
    }

    public function saveTimeTable()
        {
            $id = $this->request->getPost('id');

            $formData = [
                'school_id'  => $this->request->getPost('school_id'),
                'class_id'   => $this->request->getPost('class_id'),
                'section_id' => $this->request->getPost('section_id'),
                'period_id'  => $this->request->getPost('period_id'),
                'day'        => $this->request->getPost('day'),
            ];

            if ($id) {
                $this->timeTableModel->update($id, $formData);
                $message = 'Timetable updated successfully';
            } else {
                $this->timeTableModel->insert($formData);
                $message = 'Timetable added successfully';
            }

            return redirect()
                ->to(route_to('timeTablePage'))
                ->with('success', $message);
        }

    public function timeSlotPage(){
         $limit = PER_PAGE;
      
        $allTimeSlotTable = $this->timeSlotModel
    ->getSlotsWithDetails()
    ->paginate($limit);

        $allUser = $this->userModel
            ->paginate($limit);
        $allTimetable = $this->timeTableModel
            ->paginate($limit);
        $allSubject = $this->subjectModel
            
            ->paginate($limit);
        $allPeriod = $this->periodModel
            ->paginate($limit);
       
        $data = [
            'title'         => 'Time Slot Table',
            'lists'         => $allTimeSlotTable,
            'pager'         => $this->timeSlotModel->pager,
            'limit'         => $limit,
            'timeTable'     =>$allTimetable,
            'users'         => $allUser,
            'subjects'      => $allSubject,
            'periods'       => $allPeriod,
        ];
        return view('admin/timetables/time_table_slots', $data);
    }
public function saveTimeSlot()
{
    $data = [
        'timetable_id' => $this->request->getPost('timetable_id'),
        'period_id'    => $this->request->getPost('period_id'),
        'subject_id'   => $this->request->getPost('subject_id'),
        'user_id'      => $this->request->getPost('user_id'),
    ];

    // 1️⃣ Prevent duplicate slot
    $exists = $this->timeSlotModel
        ->where('timetable_id', $data['timetable_id'])
        ->where('period_id', $data['period_id'])
        ->first();

    if ($exists) {
        return redirect()->back()->with('error', 'Slot already exists for this period');
    }

    // 2️⃣ Prevent teacher clash
    $teacherBusy = $this->timeSlotModel
        ->where('user_id', $data['user_id'])
        ->where('period_id', $data['period_id'])
        ->first();

    if ($teacherBusy) {
        return redirect()->back()->with('error', 'Teacher already assigned in this period');
    }

    $this->timeSlotModel->insert($data);

    return redirect()->back()->with('success', 'Time slot added successfully');
}

}
