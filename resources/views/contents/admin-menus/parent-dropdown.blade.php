@if (!empty($parent_menus))
    {!! Form::select('parent_menu', $parent_menus, auth()->User()->state_id ?? '', [
        'class' => 'select2 form-select form-select-lg',
        'id' => $slug.'ParentMenu',
        'placeholder' => 'Select Parent Menu',
        'data-allow-clear' => 'true',
    ]) !!}
@else
    {!! Form::select('parent_menu', [], false, [
        'class' => 'select2 form-select form-select-lg',
        'id' => $slug.'ParentMenu',
        'placeholder' => 'Select Parent Menu',
        'data-allow-clear' => 'true',
    ]) !!}
@endif
