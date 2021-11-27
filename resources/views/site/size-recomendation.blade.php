@extends('layouts.application')
@section('pagetitle', 'Feedback')
@section('content')

<div class="container content">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-lg-5 size-rec-left-container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="size-rec-title">Size Recomendation!</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-12 mt-3">
                        <p>Insert the  size of your weight and your height also your gender. 
                            Worry not, it will be our little secret! 
                            It’s safe to share. 
                            (P.s. every size number is awesome!) 
                        </p>
                        <p>
                            After you clicked Submit, our MYJI
                            mini troops behind the screen is going
                            to look for the perfect size for you!
                        </p>
                        <p>
                            And voila! the matched size will pop up 
                            into your screen.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 size-rec-right-container pt-4 ">
                
                <div class="row mb-5 justify-content-end">
                    <div class="col-lg-9 col-md-12 ">
                        <form action="javascript:;" id="formMeasurement">
                            <div class="row">
                                <div class="col-lg-12 size-rec-content-head">
                                    <h5>Insert your mesasurements</h5>
                                </div>
                            </div>
                        
                            <div class="row my-3">
                                <div class="col-lg-12">
                                    <label for="gender">gender</label>
                                    <select class="size-rec-input" id="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-lg-12">
                                    <label for="measurementB">measurement weight</label>
                                    <input type="number" min="40" max="95" class="size-rec-input" id="measurementB" name="size-rec-input-design" />
                                    <small>40-95 kg</small>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-lg-12">
                                    <label for="measurementC">measurement height</label>
                                    <input type="number" min="145" max="185" class="size-rec-input" id="measurementC" name="size-rec-input-design" />
                                    <small>145-185 cm</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <input type="submit" value="SUBMIT" class="btn button-primary button-feedback float-left">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
        
    </div>

@endsection

@section('additionalJs')
    <script type='text/javascript'>
    @php
        $measurement_json = json_encode($measurement);
        echo "var measurement = ". $measurement_json . ";\n";
        @endphp
    </script>

    <script>
    $("#formMeasurement > input[type='submit']").click(()=>{
        $("#formMeasurement").submit()
    });


    $("#formMeasurement").on("submit",function(){
        $("#modalMeasurementResult").modal({ keyboard: false });
        // Size Calculation
        let gender = $("#gender").val() 
        let weight = $("#measurementB").val()
        let height = $("#measurementC").val()

        let point = weight * height;
        var size = 'Unknown';
        measurement.forEach(element => {
            if (point <= element['point']) {
                console.log(point+ '-'+ element['point']+'-'+element['code']);
                size = element['code'];
            }    
        });

        $("#result-size").html("<div class='px-3'><h4 class='text-center mb-0' id='myji-measurement-size-recomendation-value'>" + size + "</h4><span >size</span></div>");
    });
    </script>
@endsection

@section('modals')

<!-- modal measurement result -->
<div class="modal fade myji-modal" tabindex="-1" role="dialog" id="modalMeasurementResult">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-3 px-4 pt-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 pt-5 text-center">
                            <h5 class="text-center py-4">ACCORDING TO OUR CALCULATION, WE SUGGEST YOU TO TAKE...</h5>
                            <div id="result-size" class="d-flex justify-content-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-body px-5 pt-4 pb-5 mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 px-5 py-4 myji-measurement-modal-body">
                            <table class="table-responsive table-measurement" id="table-measurement">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $before = 0;
                                    @endphp
                                    @foreach ($measurement as $key=>$size)
                                        @php
                                            if(isset($measurement[$key+1])){
                                                $before = $measurement[$key+1]['point']+1;
                                            }else{
                                                $before=0;
                                            }
                                            
                                        @endphp
                                        <tr>
                                            <td>{{$size['code']}}</td>
                                            <td>Weight (Kg) x Height (Cm) = {{$before}} - {{$size['point']}} point</td>
                                        </tr>

                                       
                                    @endforeach
                                    <!-- <tr>
                                        <td>
                                            Size 1
                                        </td>
                                        <td>
                                            PB: 51 | LD: 52 | PT: 19 | LK: 44
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Size 1 (Long Sleeve)
                                        </td>
                                        <td>
                                            PB: 51 | LD: 52 | PT: 56    | LK: 44
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Size 2
                                        </td>
                                        <td>
                                            PB: 70 | LD: 56 | PT: 27,5 | LK: 53
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Size 3
                                        </td>
                                        <td>
                                            PB: 79 | LD: 60 | PT: 27,5 | LK: 55
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of modal measurement result -->


@endsection