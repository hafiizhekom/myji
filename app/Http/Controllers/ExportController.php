<?php

namespace App\Http\Controllers;

use App\Excels\Exports\ProductionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Production;
use App\Models\Purchasing;
 
class ExportController extends Controller
{
    public function production($id) 
    {
        $purchasing = Purchasing::where('id',$id)->first();
        $productDetail_array = Production::where('purchasing_id', $id)->distinct()->pluck('product_detail_id')->toArray();

        
        return Excel::download(new ProductionExport($id, count($productDetail_array)), 'Production '.$purchasing->po_code.'.xlsx');
    }
}

