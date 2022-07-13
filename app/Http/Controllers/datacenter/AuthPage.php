<?php

namespace App\Http\Controllers\datacenter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthPage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('datacenter.login', ['pageConfigs' => $pageConfigs]);
  }
  public function datatable()
  {

    return view('datacenter.tables-datatables');
  }
  public function analy()
  {

    return view('datacenter.dashboards-analytics');
  }
  public function people()
  {
    $pageConfigs = ['myLayout' => 'horizontal'];
    return view('datacenter.dashboards', ['pageConfigs' => $pageConfigs]);
  }
}


