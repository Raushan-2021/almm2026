@extends('layouts.masters.backend')
@section('content')
@section('title', 'Feedback')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
            </div>
            <div class="col-md-12">
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            {{-- <th>SNo.</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbackData as $key => $data)
                        <tr>
                            {{-- <td>{{ $key + 1 }}</td> --}}
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->type == 1 ? 'Feedback' : 'Query' }}</td>
                            <td>
                                @if (strlen($data->message) > 50)
                                    {{ Str::limit($data->message, 50) }}
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $data->id }}" style="text-decoration: underline"> View More</a>
                                @else
                                    {{ $data->message }}
                                @endif
                            </td>
                            <td width="12%">{{ $data->created_at_human }}</td>
                        </tr>

                        <!-- View Message Modal -->
                        <div class="modal fade" id="viewMessageModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewMessageModalLabel{{ $data->id }}">{{$data->type == 1 ? 'Feedback' : 'Query'}}</h5>
                                    </div>
                                    <div class="modal-body">
                                        {{ $data->message }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="closeModal({{$data->id}})">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{{ $feedbackData->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
<script>
function closeModal(id) {
    $("#viewMessageModal"+id).modal('hide');
}
</script>
@endsection