<?php

namespace App\Controllers;

use App\Models\Tiket;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\Pesan;
use stdClass;

class ReportController extends BaseController
{
    protected $Tiket;
    protected $db;


    public function __construct()
    {
        $this->Tiket = new Tiket();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $status = $this->request->getVar('status');
        $case = $this->request->getVar('case');
        $regional  = $this->request->getVar('regional');
        $startTime = $this->request->getVar('startTime');
        $endTime = $this->request->getVar('endTime');

        $start = $startTime ? $startTime : date('Y-m-d', strtotime('-1 days'));
        $end = $endTime ? $endTime : date('Y-m-d');

        $Pesan = new Pesan();

        $builder = $this->Tiket
            ->select('tiket_id,awb,seller_name,tikets.origin,tikets.regional,tikets.case_id as case_id,case,tikets.status,urgency,closed_at,customer_name,account,desc,seller_address,seller_phone,city,users.username,sla,zona,tikets.created_at as created_at')
            ->join('cases', 'tikets.case_id = cases.id')
            ->join('users', 'tikets.user_id = users.id')
            ->join('cities', 'tikets.city_id = cities.id')
            ->where('tikets.deleted_at', NULL)
            ->orderBy('tikets.created_at', 'asc')
            ->limit(10000);

        if ($status) {
            $builder->where('status', $status);
        } elseif ($case) {
            $builder->where('case_id', $case);
        } elseif ($regional) {
            $builder->where('regional', $regional);
        } else {
            $builder->where('tikets.created_at >=', $start);
            $builder->where('tikets.created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        }
        $tikets = $builder->get()->getResultArray();

        foreach ($tikets as $index => $tiket) {
            // SLA FLAG
            $waktuawal  = date_create($tiket['created_at']);
            if ($tiket['status'] == 'CLOSE') {
                $waktuakhir = date_create($tiket['created_at']);
                $diff  = date_diff($waktuawal, $waktuakhir);

                if ($tiket['zona'] == 'A' || $tiket['zona'] == 'B') {
                    if ($diff->d > 1) {
                        array_push($tikets[$index], 'OVER SLA');
                    } else {
                        array_push($tikets[$index], 'SLA');
                    }
                } else {
                    if ($diff->d > 3) {
                        array_push($tikets[$index], 'OVER SLA');
                    } else {
                        array_push($tikets[$index], 'SLA');
                    }
                }
            } else {
                $waktuberjalan = date_create();
                $diff  = date_diff($waktuawal, $waktuberjalan);

                if ($tiket['zona'] == 'A' || $tiket['zona'] == 'B') {
                    if ($diff->d >= 3) {
                        array_push($tikets[$index], 'OVER SLA');
                    } else {
                        array_push($tikets[$index], 'SLA');
                    }
                } else {
                    if ($diff->d >= 5) {
                        array_push($tikets[$index], 'OVER SLA');
                    } else {
                        array_push($tikets[$index], 'SLA');
                    }
                }
            }

            // LAST MESSAGE
            if ($tiket['status'] !== 'CLOSE') {
                array_push($tikets[$index], '');
            } else {
                $messages = $this->db->table('messages')
                    ->select('pesan')
                    ->where('tiket_id', $tiket['tiket_id'])
                    ->orderBy('created_at', 'DESC');
                $query   = $messages->get()->getRow();

                if ($query !== NULL) {
                    array_push($tikets[$index], $query->pesan);
                } else {
                    array_push($tikets[$index], "");
                }
            }


            // PIC CLOSE

            $builder = $this->db->table('messages')
                ->select('username')
                ->join('users', 'users.id = messages.user_id')
                ->where('tiket_id', $tiket['tiket_id'])
                ->orderBy('messages.created_at', 'DESC');
            $query   = $builder->get()->getRow();

            if ($query !== NULL) {
                array_push($tikets[$index], $query->username);
            } else {
                array_push($tikets[$index], '');
            }


            // PIC TAKE

            $builder = $this->db->table('messages')
                ->select('username')
                ->join('users', 'users.id = messages.user_id')
                ->where('tiket_id', $tiket['tiket_id'])
                ->orderBy('messages.created_at', 'ASC');
            $query   = $builder->get()->getRow();

            if ($query !== NULL) {
                array_push($tikets[$index], $query->username);
            } else {
                array_push($tikets[$index], '');
            }

            // SLA Berjalan
            if ($tiket['status'] == 'CLOSE') {
                $waktuakhir = date_create($tiket['closed_at']);
                $diff  = date_diff($waktuawal, $waktuakhir);
                array_push($tikets[$index], $diff->d);
            } else {
                $waktuberjalan = date_create();
                $diff  = date_diff($waktuawal, $waktuberjalan);
                array_push($tikets[$index], $diff->d);
            }
        }
        $data = [
            'title' => 'Tiket',
            'validation' => \config\Services::validation(),
            'cases' => $this->Tiket->distinct()->findColumn('case_id'),
            'regionals' => $this->Tiket->distinct()->findColumn('regional'),
            'notif' => $Pesan->notif(),
            'tikets' => $tikets
        ];
        return view('reports/index', $data);
    }
}
