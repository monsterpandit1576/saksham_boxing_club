<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Assign To')}}</h6>
                <p class="mb-20">{{ ucfirst($workout->assign_to) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Assign')}}</h6>
                <p class="mb-20">
                    @if($workout->assign_to=='trainee')
                        {{!empty($workout->assignDetail)?$workout->assignDetail->name:'-' }}
                    @else
                        {{!empty($workout->assignDetail)?$workout->assignDetail->title:'-' }}
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Start Date')}}</h6>
                <p class="mb-20"> {{ dateFormat($workout->start_date) }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('End Date')}}</h6>
                <p class="mb-20">{{ dateFormat($workout->start_date) }}</p>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Notes')}}</h6>
                <p class="mb-20">{{ $workout->notes}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Days')}}</th>
                        <th>{{__('Activity')}}</th>
                        <th>{{__('Weight')}}</th>
                        <th>{{__('Sets')}}</th>
                        <th>{{__('Reps')}}</th>
                        <th>{{__('Rest')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{$history->days}}</td>
                            <td>{{\App\Models\Workout::activities($history->activity)}}</td>
                            <td>{{$history->weight}}</td>
                            <td>{{$history->sets}}</td>
                            <td>{{$history->reps}}</td>
                            <td>{{$history->rest}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
