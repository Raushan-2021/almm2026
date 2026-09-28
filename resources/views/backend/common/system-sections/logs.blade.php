@if (count($logs ?? 0) > 0)
    @foreach ($logs as $key => $log)
    <div class="log-block">
        <h4>
            @switch($log->review_action)
                @case('MD') Feedback @break
                @case('AC') Accepted @break
                @case('AP') Approved @break
            @endswitch
        </h4>
        <span><b>Stage: </b> @if($log->review_type == 'A') Installation @else Inspection @endif</span>
        <span class="ml-15"><b>Date: </b> @if($log->created_at) <i class="fa fa-calendar" aria-hidden="true"></i> {{date('d M Y', strtotime($log->created_at))}} @endif</span>
        <div class="clearfix"></div>
        <span><b>By: </b> @if($log->review_type == 'A') {{$log->agency_username}} @else {{$log->inspector_username}} @endif</span>
        <div class="mt-10">
            <span><b>Comments:</b> {{$log->review}}</span><br>
        </div>
        @if (!empty(json_decode($log->docs, true)))
            <span><b>Documents required to be updated:</b></span><br>
            @foreach (json_decode($log->docs, true) as $doc)
                <li>{{$documentCodes[$doc]}}</li>
            @endforeach
        @endif
    </div>
    @endforeach
@endif