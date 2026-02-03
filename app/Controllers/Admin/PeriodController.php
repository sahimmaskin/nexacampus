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
    $id = $this->request->getPost('id'); // hidden input for edit

    $data = [
        'timetable_id' => $this->request->getPost('timetable_id'),
        'period_id'    => $this->request->getPost('period_id'),
        'subject_id'   => $this->request->getPost('subject_id'),
        'user_id'      => $this->request->getPost('user_id'),
    ];

    /**
     *  Prevent duplicate slot (same timetable + same period)
     */
    $duplicateQuery = $this->timeSlotModel
        ->where('timetable_id', $data['timetable_id'])
        ->where('period_id', $data['period_id']);

    if ($id) {
        // exclude current record while updating
        $duplicateQuery->where('id !=', $id);
    }

    if ($duplicateQuery->first()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Slot already exists for this period');
    }

    /**
     * 🔒 Prevent teacher clash (same teacher + same period)
     */
    $teacherQuery = $this->timeSlotModel
        ->where('user_id', $data['user_id'])
        ->where('period_id', $data['period_id']);

    if ($id) {
        $teacherQuery->where('id !=', $id);
    }

    if ($teacherQuery->first()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Teacher already assigned in this period');
    }

    /**
     * 💾 Save data
     */
    if ($id) {
        $this->timeSlotModel->update($id, $data);
        $message = 'Time slot updated successfully';
    } else {
        $this->timeSlotModel->insert($data);
        $message = 'Time slot added successfully';
    }

    return redirect()
        ->back()
        ->with('success', $message);
}


}
