@inject('general', 'App\Http\Controllers\Backend\Users\AnnexureController')
@php
    function int_to_roman($number)
    {
        $roman_numerals = [
            'm' => 1000,
            'cm' => 900,
            'd' => 500,
            'cd' => 400,
            'c' => 100,
            'xc' => 90,
            'l' => 50,
            'xl' => 40,
            'x' => 10,
            'ix' => 9,
            'v' => 5,
            'iv' => 4,
            'i' => 1,
        ];

        $result = '';
        foreach ($roman_numerals as $roman => $value) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }
        return $result;
    }
@endphp
<style>
    .mnre-table table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    .mnre-table th {
        background-color: #d9d9d9;
        padding: 8px;
        text-align: left;
        border: 1px solid #999;
    }

    .mnre-table td {
        padding: 8px;
        border: 1px solid #999;
    }

    .mnre-table th[colspan="2"] {
        text-align: center;
    }

    .f5 {
        font-size: 11px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .mnre-table .first td {
        vertical-align: top;
    }

    .text-center {
        text-align: center;
    }

    div.breakNow {
        page-break-inside: avoid;
        page-break-after: always;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="float-end text-center f5">Annexure - I
                    {{-- <hr class="m-0 p-0"> Revision - XXIII --}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="mnre-table" style="font-size: 8px; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="14" style="text-align: center">List of Manufacturers and Models of Solar
                                    PV
                                    Modules Enlisted under ALMM Order (As on {{ date('d.m.Y') }})</th>
                            </tr>
                            <tr>
                                <th rowspan="2">S. No.</th>
                                <th rowspan="2">Name of the Manufacturer</th>
                                <th rowspan="2">Location of Manufacturing Facility</th>
                                <th rowspan="2">BIS Registration No.</th>
                                <th rowspan="2">Enlisted Capacity (MWs / Year)</th>
                                <th rowspan="2">S. No.</th>
                                <th rowspan="2">Type of Module</th>
                                <th rowspan="2">Applied Model</th>
                                <th rowspan="2">Enlisted Models</th>
                                <th rowspan="2">Module Efficiency (%)</th>
                                <th rowspan="2">No. of Cells in Module</th>
                                <th rowspan="2">System Voltage (in Volts)</th>
                                <th colspan="2">Validity</th>

                            </tr>
                            <tr>
                                <th>From</th>
                                <th>To (subject to valid IIS being extended)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicationDetails as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->manufacturer_name }}</td>
                                    <td>{{ $data->register_office_address }}</td>
                                    <td>{{ $data->bis[0]->bis_certificate_no }}</td>
                                    <td>{{ $data->manufacturing_capacity }} MW</td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                <tr>
                                                    <td style="border: none; border-bottom: 1px dashed #999">{{ int_to_roman($loop->iteration) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                <tr>
                                                    <td style="border: none; border-bottom: 1px dashed #999">{{ $annexure1->module_name }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                <tr>
                                                    <td style="border: none; border-bottom: 1px dashed #999">{{ $annexure1->main_model }} ({{ $annexure1->pmax_model }} Wp)
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                @foreach ($annexure1->applicable_model_covered as $amc)
                                                    <tr>
                                                        <td style="border: none; border-bottom: 1px dashed #999">{{ $amc }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                @foreach ($annexure1->applicable_model as $am)
                                                    <tr>
                                                        <td style="border: none; border-bottom: 1px dashed #999">{{ $am }} Wp</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                @foreach ($annexure1->annexure as $ann_data)
                                                    <tr>
                                                        <td style="border: none; border-bottom: 1px dashed #999">{{ $ann_data->no_of_cells }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach ($data->annexure1 as $annexure1)
                                                @foreach ($annexure1->annexure as $ann_data2)
                                                    <tr>
                                                        <td style="border: none; border-bottom: 1px dashed #999">{{ $ann_data2->system_voltage }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>{{ $data->bis[0]->bis_certificate_issue }}</td>
                                    <td>{{ $data->bis[0]->bis_certificate_valid }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
