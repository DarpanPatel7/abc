@if (!empty($states))
    {{ html()->select('state', $states, auth()->User()->state_id ?? '')
        ->id($slug.'State')
        ->class('select2 form-select form-select-lg')
        ->placeholder('Select State')
        ->attributes([
            'data-allow-clear' => 'true'  // Add more attributes here as needed
        ])
    }}
@else
    {{ html()->select('state', [], [])
        ->id($slug.'State')
        ->class('select2 form-select form-select-lg')
        ->placeholder('Select State')
        ->attributes([
            'data-allow-clear' => 'true'  // Add more attributes here as needed
        ])
    }}
@endif
