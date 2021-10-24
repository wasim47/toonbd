<?php
namespace App;
  
use App\Hospital;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
	public function collection()
    {
        return Hospital::all();
    }
}
