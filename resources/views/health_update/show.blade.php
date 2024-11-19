<div class="modal-body wrapper">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Trainee')}}</h6>
                <p class="mb-20">{{ !empty($health->users)?$health->users->name:'-' }} </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="detail-group">
                <h6>{{__('Date')}}</h6>
                <p class="mb-20">{{ dateFormat($health->measurement_date) }}</p>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="detail-group">
                <h6>{{__('Notes')}}</h6>
                <p class="mb-20">{{ $health->notes}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Measurement Type')}}</th>
                        <th>{{__('Measurement Result')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($healthHistory as $history)
                        <tr>
                            <td>{{$history->type}}</td>
                            <td>{{$history->result}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
