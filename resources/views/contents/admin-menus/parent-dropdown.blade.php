@if (!empty($parent_menus))
    {{
        html()->select('parent_menu', $parent_menus, auth()->User()->state_id ?? '')
        ->id($slug.'ParentMenu')
        ->class('select2 form-select form-select-lg')
        ->placeholder('Select Parent Menu')
        ->attributes([
            'data-allow-clear' => 'true'  // Add more attributes here as needed
        ])
    }}
@else
    {{
        html()->select('parent_menu', [], [])
        ->id($slug.'ParentMenu')
        ->class('select2 form-select form-select-lg')
        ->placeholder('Select Parent Menu')
        ->attributes([
            'data-allow-clear' => 'true'  // Add more attributes here as needed
        ])
    }}
@endif
