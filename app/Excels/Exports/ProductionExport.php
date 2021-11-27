<?php 
namespace App\Excels\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Illuminate\Support\Collection;


use App\Models\Purchasing;
use App\Models\Production;
use App\Models\ProductDetail;

class ProductionExport implements FromView,ShouldAutoSize, WithColumnWidths, WithEvents,WithProperties
{
    use Exportable, RegistersEventListeners;
    protected $id;
    protected $length;
    public function __construct($id, $length)
    {
        //
        $this->id = $id;
        $this->length = $length;
    }

    public function properties(): array
    {
        return [
            'creator' => 'MYJI Website'
        ];
    }


    
    public function registerEvents(): array
    {

        
        return [
            BeforeSheet::class => function (BeforeSheet $event) {

                
                $event->sheet->getStyle('A8:I'.(8+$this->length))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A1:I6')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            }
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 10,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 10,
            'G' => 10,
        ];
    }

    public function view(): View{
        $id = $this->id;
        $request = [];
        $actualTotal = [];
        $requestTotal = [];
        $purchasing = Purchasing::where('id',$id)->first();

        $productDetail_array = Production::where('purchasing_id', $id)->distinct()->pluck('product_detail_id')->toArray();

        $tempProduct = [];
        foreach ($productDetail_array as $key => $product_detail_id) {
            
            $productDetail = ProductDetail::where('id', $product_detail_id)->first();
            $production = Production::where('product_detail_id', $productDetail->id)->where('purchasing_id', $id)->first();
            $request[$productDetail->product_id]['product'] = $productDetail->product;
            $request[$productDetail->product_id][$productDetail->size_id]['product_detail_id'] = $productDetail->id;
            $request[$productDetail->product_id][$productDetail->size_id]['product_detail'] = $productDetail;
            $request[$productDetail->product_id][$productDetail->size_id]['value'] = $production->request;
            
            if(array_key_exists($productDetail->product_id, $actualTotal)){
                array_push($actualTotal[$productDetail->product_id], $production->actual);
            }else{
                $actualTotal[$productDetail->product_id] = [];
                array_push($actualTotal[$productDetail->product_id], $production->actual);
            }

            if(array_key_exists($productDetail->product_id, $requestTotal)){
                array_push($requestTotal[$productDetail->product_id], $production->request);
            }else{
                $requestTotal[$productDetail->product_id] = [];
                array_push($requestTotal[$productDetail->product_id], $production->request);
            }
        }

        
        $tempSize =[];
        $size = \App\Models\Size::all();
        foreach ($size as $valueSize) {
            array_push($tempSize, $valueSize);
        }
        
        return view( 
            'excel.report.production'
            ,[
                'purchasing'=>$purchasing,
                'request'=>$request,
                'actualTotal'=>$actualTotal,
                'requestTotal'=>$requestTotal,
                'size'=>$tempSize
            ]
        ); 
    }


    private function generate($id){
        $request = [];
        $actualTotal = [];
        $requestTotal = [];
        $purchasing = Purchasing::where('id',$id)->first();

        $productDetail_array = Production::where('purchasing_id', $id)->distinct()->pluck('product_detail_id')->toArray();

        $tempProduct = [];
        foreach ($productDetail_array as $key => $product_detail_id) {
            
            $productDetail = ProductDetail::where('id', $product_detail_id)->first();
            $production = Production::where('product_detail_id', $productDetail->id)->where('purchasing_id', $id)->first();
            $request[$productDetail->product_id]['product'] = $productDetail->product;
            $request[$productDetail->product_id][$productDetail->size_id]['product_detail_id'] = $productDetail->id;
            $request[$productDetail->product_id][$productDetail->size_id]['product_detail'] = $productDetail;
            $request[$productDetail->product_id][$productDetail->size_id]['value'] = $production->request;
            
            if(array_key_exists($productDetail->product_id, $actualTotal)){
                array_push($actualTotal[$productDetail->product_id], $production->actual);
            }else{
                $actualTotal[$productDetail->product_id] = [];
                array_push($actualTotal[$productDetail->product_id], $production->actual);
            }

            if(array_key_exists($productDetail->product_id, $requestTotal)){
                array_push($requestTotal[$productDetail->product_id], $production->request);
            }else{
                $requestTotal[$productDetail->product_id] = [];
                array_push($requestTotal[$productDetail->product_id], $production->request);
            }
        }

        // $product = Product::whereIn('id', $tempProduct)->get();
        $tempSize =[];
        $size = \App\Models\Size::all();
        foreach ($size as $valueSize) {
            array_push($tempSize, $valueSize);
        }
        // foreach ($product as $keyProduct => $valueProduct) {
        //     foreach ($size as $keySize => $valueSize) {
        //         $productDetail = ProductDetail::where('product_id', $valueProduct->id)->where('size_id', $valueSize->id)->get();
        //         $result[$valueProduct->id][$valueSize->id]['product_detail'] = $productDetail;
        //     }  
        // }


        $export = array(
            ["","PO Code", $purchasing->po_code],
            ["","PO Date", $purchasing->order_date],
            ["","PO Date", $purchasing->order_date],
            [""],
            ["No", "Name"]
        );

        

        foreach ($size as $key => $value) {
           $export[count($export)-1][count($export[count($export)-1])]=$value->size_code;
        }
        array_push($export[count($export)-1], 'Total Request');
        array_push($export[count($export)-1], 'Total Actual');

        $i=0;
        foreach ($request as $keyReq => $valReq) {
            $i++;
            $tempArray = array(
                    $i, 
                    $valReq['product']->product_name
            );
            foreach ($size as $keySize => $valSize) {
                if(array_key_exists($valSize->id, $valReq)){
                    $fill = $valReq[$valSize->id]['value'];
                }else{
                    $fill=0;
                }
               array_push($tempArray, $fill);
            }
           array_push($tempArray,array_sum($requestTotal[$keyReq]));
           array_push($tempArray,array_sum($actualTotal[$keyReq]));
           $export[count($export)]=$tempArray;
        //    array_push($export[count($export)+1], "tempArray");
        }
        
        
        return $export; 
    }

    public function collection()
    {
        return new Collection($this->generate($this->id));
    }

}
