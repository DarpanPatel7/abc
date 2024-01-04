@if (!empty($states))
    {!! Form::select('state', $states, auth()->User()->state_id ?? '', [
        'class' => 'select2 form-select form-select-lg',
        'id' => 'state',
        'placeholder' => 'Select State',
        'data-allow-clear' => 'true',
    ]) !!}
@else
    {!! Form::select('state', [], false, [
        'class' => 'select2 form-select form-select-lg',
        'id' => 'state',
        'placeholder' => 'Select State',
        'data-allow-clear' => 'true',
    ]) !!}
@endif
