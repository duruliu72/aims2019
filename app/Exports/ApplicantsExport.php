<?php

namespace App\Exports;

use App\com\adventure\school\admission\Applicant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicantsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export_import.excel', [
            'applicant_data' => Applicant::all()
        ]);
    }
}
