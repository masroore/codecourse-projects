@foreach($histories as $history)
    <div>
        Changed <strong>{{ $history->changed_column }}</strong> from <strong>{{ $history->changed_value_from }}</strong> to <strong>{{ $history->changed_value_to }}</strong> on <strong>{{ $history->created_at->toDateTimeString() }}</strong>
    </div>
@endforeach