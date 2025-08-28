<?php
   
namespace App\Http\Controllers\Admin;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
  
class ExportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */

}