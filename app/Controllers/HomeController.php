<?php

namespace App\Controllers;

use App\Models\Pesan;
use App\Models\Tiket;


class HomeController extends BaseController
{
    protected $db;
    protected $Tiket;
    public function __construct()
    {
        $this->Tiket = new Tiket;
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $db      = \Config\Database::connect();
        $Pesan = new Pesan();


        $data = [
            'title' => 'Dashboard',
            'cases' => $this->Tiket->join('cases', 'tikets.case_id = cases.id')->select('case ,case_id')->distinct('case_id', 'case')->get()->getResult(),
            'users' => $this->Tiket->join('users', 'tikets.user_id = users.id')->select('users.id ,username')->distinct('users.id')->get()->getResult(),
            'origins' => $this->Tiket->join('cities', 'tikets.city_id = cities.id')->select('city_id ,code_3lc')->distinct('city_id')->get()->getResult(),
            'regionals' => $this->Tiket->distinct()->findColumn('regional'),
            'notif' => $Pesan->notif()
        ];

        return view('dashboard', $data);
    }

    public function datadashboard()
    {
        // var_dump($this->request->getVar());
        $start = $this->request->getVar('startTime');
        $end = $this->request->getVar('endTime');
        $statusDash = $this->request->getVar('statusDash');
        $CaseDash = $this->request->getVar('CaseDash');
        $RegionalDash = $this->request->getVar('RegionalDash');
        $PicDash  = $this->request->getVar('PicDash');
        $OriginDash  = $this->request->getVar('originDash');

        $builder = $this->db->table('tikets')
            ->select('*')
            ->join('cases', 'tikets.case_id = cases.id')->join('cities', 'tikets.city_id = cities.id');
        if ($statusDash !== '') {
            $builder->where('status', $statusDash);
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else if ($CaseDash !== '') {
            $builder->where('case_id', $CaseDash);
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else if ($RegionalDash !== '') {
            $builder->where('regional', $RegionalDash);
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else if ($PicDash !== '') {
            $builder->where('user_id', $PicDash);
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else if ($OriginDash !== '') {
            $builder->where('code_3lc', $OriginDash);
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else {
            $builder->where('created_at >= ', $start);
            $builder->where('created_at <= ', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        }

        $query   = $builder->get()->getResultArray();


        foreach ($query as $data) {
            $case[] = $data['case_id'];
            $status[] = $data['status'];
            $origin[] = $data['origin'];
            $customer[] = $data['customer_name'];
            $regional[$data['regional']][] = $data['status'];

            $day  = strtoupper(date('d/M', strtotime($data['created_at'])));

            $industry[$day][] = $data['status'];
        }

        $datacase = array_count_values($case);
        $dataStatus = array_count_values($status);
        $dataCustomer = array_count_values($customer);
        $dataOrigin = array_count_values($origin);


        // Case
        arsort($datacase);
        arsort($dataCustomer);
        arsort($dataOrigin);

        foreach ($datacase as $key => $value) {
            $dataChartCase[] = $key;
            $dataChartValCase[] = $value;
        }

        $dataCase = [
            'id' => $dataChartCase,
            'value' => $dataChartValCase
        ];

        // end Case

        // Status

        $totalTiket = count($status);
        $dataTicket = [
            'totalTiket' => $totalTiket,
            'CLOSE' => (!empty($dataStatus['CLOSE']) ? $dataStatus['CLOSE'] : 0),
            'OPEN' => (!empty($dataStatus['OPEN']) ? $dataStatus['OPEN'] : 0),
            'PROGRESS' => (!empty($dataStatus['PROGRESS']) ? $dataStatus['PROGRESS'] : 0)
        ];

        // end Status

        // Regional


        foreach ($regional as $key => $value) {
            $reg[$key] = array_count_values($value);
        }


        foreach ($reg as $i => $data) {
            $regi[] = $i;
            foreach ($data as $key => $value) {
                $regiVal[$key][$i] = $value;
            }
        }

        $dataRegional = [
            'id' => $regi,
            'value' => $regiVal
        ];

        // endRegioan

        // customer

        $i = 0;
        foreach ($dataCustomer as $key => $value) {
            $dataChartcustomer[] = $key;
            $dataChartValCustomer[] = $value;
            if (++$i == 10) break;
        }

        $dataCustomer = [
            'id' => $dataChartcustomer,
            'value' => $dataChartValCustomer
        ];

        // endCustomer

        // Origin

        $i = 0;
        foreach ($dataOrigin as $key => $value) {
            $dataChartOrigin[] = $key;
            $dataChartValOrigin[] = $value;
            if (++$i == 10) break;
        }

        $dataOrigin = [
            'id' => $dataChartOrigin,
            'value' => $dataChartValOrigin
        ];

        // End Origin
        // Month
        foreach ($industry as $key => $value) {
            $inds[$key] = array_count_values($value);
        }

        foreach ($inds as $i => $data) {
            $ind[] = $i;
            foreach ($data as $key => $value) {
                $indsVal[$key][$i] = $value;
            }
        }

        $dataMonth = [
            'id' => $ind,
            'value' => $indsVal
        ];


        // lempar

        $dataAll = [
            'dataTiket' => $dataTicket,
            'dataCase' => $dataCase,
            'dataRegional' => $dataRegional,
            'dataCustomer' => $dataCustomer,
            'dataOrigin' => $dataOrigin,
            'dataMonths' => $dataMonth
        ];

        return json_encode($dataAll);
    }
}
