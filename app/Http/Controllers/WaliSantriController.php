<?php

namespace App\Http\Controllers;

use App\DataTables\WaliSantriDataTable;
use Illuminate\Http\Request;

class WaliSantriController extends Controller
{
    public function index(WaliSantriDataTable $dataTable) {
        return $dataTable->render('pages.admin.wali-santri');
    }
}
