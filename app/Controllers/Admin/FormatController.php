<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SessionModel;
use App\Models\FormatTypeModel;
use App\Models\FormatNumbersModel;

class FormatController extends BaseController
{
    protected $trustId;
    protected $schoolId;
    protected $sessionModel;
    protected $formatTypeModel;
    protected $formatNumbersModel;
    public function __construct()
    {
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
        $this->sessionModel = new SessionModel();
        $this->formatTypeModel = new FormatTypeModel();
        $this->formatNumbersModel = new FormatNumbersModel();
    }

    public function formatList()
    {
        $limit = PER_PAGE;

        $this->formatTypeModel
            ->select([
                'format_numbers.*',

                'format_type.id AS format_type_id',
                'format_type.name',
                'format_type.status',
            ])
            ->join(
                'format_numbers',
                'format_numbers.format_type = format_type.id
         AND format_numbers.school_id = ' . (int)$this->schoolId . '
         AND format_numbers.trust_id = ' . (int)$this->trustId,
                'left'
            )
            ->where('format_type.status', 'Active');

        $formats = $this->formatTypeModel->paginate($limit);

        $sessions = $this->sessionModel
            ->where('status', 'Active')
            ->findAll();

        $data = [
            'title'   => 'Formats',
            'formats' => $formats,
            'session' => $sessions,
            'pager'   => $this->formatTypeModel->pager,
            'limit'   => $limit,
        ];
        return view('admin/set-formats', $data);
    }

    public function saveFormat()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'trust_id' => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,
            'school_id' => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'format_type' => !empty($this->request->getPost('format_type_id')) ? $this->request->getPost('format_type_id') : null,
            'format_prefix' => !empty($this->request->getPost('format_prefix')) ? $this->request->getPost('format_prefix') : null,
            'format_number' => !empty($this->request->getPost('format_number')) ? $this->request->getPost('format_number') : null,
            'format_suffix' => !empty($this->request->getPost('format_suffix')) ? $this->request->getPost('format_suffix') : null
        ];

        if ($id) {
            try {
                if ($this->formatNumbersModel->update($id, $formData) === false) {
                    return redirect()->back()
                        ->with('errors', $this->formatNumbersModel->errors())
                        ->withInput();
                }

                return redirect()->to('/admin/set-formats')->with('success', 'Updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Database updation failed: ' . $e->getMessage())
                    ->withInput();
            }
        } else {
            try {
                $lastID = $this->formatNumbersModel->insert($formData);
                if ($lastID === false) {
                    return redirect()->back()
                        ->with('errors', $this->formatNumbersModel->errors())
                        ->withInput();
                }
                return redirect()->to('/admin/set-formats')->with('success', 'Added successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Database insertion failed: ' . $e->getMessage())
                    ->withInput();
            }
        }
    }
}
