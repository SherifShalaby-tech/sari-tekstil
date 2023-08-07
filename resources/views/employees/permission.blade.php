<table class="table" id="permission_table">
    <thead>
    <tr>
        <th class="">
            @lang('lang.module') {!! Form::checkbox('all_module_check_all', 1, false, ['class' => 'all_module_check_all']) !!}
        </th>
        <th>
            @lang('lang.sub_module')
        </th>
        <th class="">
            @lang('lang.select_all')
        </th>
        <th class="">
            @lang('lang.view')
        </th>
        <th class="">
            @lang('lang.create')
        </th>
        <th class="">
            @lang('lang.edit')
        </th>
        <th class="">
            @lang('lang.delete')
        </th>
    </tr>

    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td> {!! Form::checkbox('view_check_all', 1, false, ['class' => 'view_check_all']) !!}</td>
        <td> {!! Form::checkbox('create_check_all', 1, false, ['class' => 'create_check_all']) !!}</td>
        <td> {!! Form::checkbox('edit_check_all', 1, false, ['class' => 'edit_check_all']) !!}</td>
        <td> {!! Form::checkbox('delete_check_all', 1, false, ['class' => 'delete_check_all']) !!}</td>
    </tr>
    @if (session('system_mode') != 'restaurant')
        {{-- @php
            unset($modulePermissionArray['raw_material_module']);
        @endphp --}}
    @endif
    @foreach ($modulePermissionArray as $key_module => $moudle)
        <div>
            <tr class="module_permission" data-moudle="{{ $key_module }}">
                <td class="">{{ $moudle }} {!! Form::checkbox('module_check_all', 1, false, ['class' => 'module_check_all']) !!}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if (!empty($subModulePermissionArray[$key_module]))
                @php
                    $sub_module_permission_array = $subModulePermissionArray[$key_module];
                @endphp
                    @if ($key_module == 'product_module')
                        @php
                            unset($sub_module_permission_array['category']);
                            unset($sub_module_permission_array['sub_category']);
                            unset($sub_module_permission_array['brand']);
                            unset($sub_module_permission_array['color']);
                            unset($sub_module_permission_array['grade']);
                        @endphp
                    @endif
                @foreach ($sub_module_permission_array as $key_sub_module => $sub_module)
                    <tr class="sub_module_permission_{{ $key_module }}">
                        <td class=""></td>
                        <td>{{ $sub_module }}</td>
                        <td class="">
                            {!! Form::checkbox('checked_all', 1, false, ['class' => 'checked_all', 'title' => __('lang.select_all')]) !!}
                        </td>
                        @php
                            $view_permission = $key_module . '.' . $key_sub_module . '.view';
                            $create_permission = $key_module . '.' . $key_sub_module . '.create';
                            $edit_permission = $key_module . '.' . $key_sub_module . '.edit';
                            $delete_permission = $key_module . '.' . $key_sub_module . '.delete';
                        @endphp
                            <td class="">
                                {!! Form::checkbox('permissions[' . $view_permission . ']', 1, !empty($user) && !empty($user->hasPermissionTo($view_permission)) ? true : false, ['class' => 'check_box check_box_view', 'title' => __('lang.view')]) !!}
                            </td>
                            <td class="">
                                {!! Form::checkbox('permissions[' . $create_permission . ']', 1, !empty($user) && !empty($user->hasPermissionTo($create_permission)) ? true : false, ['class' => 'check_box check_box_create', 'title' => __('lang.create')]) !!}
                            </td>
                            <td class="">
                                {!! Form::checkbox('permissions[' . $edit_permission . ']', 1, !empty($user) && !empty($user->hasPermissionTo($edit_permission)) ? true : false, ['class' => 'check_box check_box_create', 'title' => __('lang.edit')]) !!}
                            </td>
                            <td class="">
                                    {!! Form::checkbox('permissions[' . $delete_permission . ']', 1, !empty($user) && !empty($user->hasPermissionTo($delete_permission)) ? true : false, ['class' => 'check_box check_box_delete', 'title' => __('lang.delete')]) !!}                     
                            </td>
                    </tr>
                @endforeach
            @endif
        </div>
    @endforeach
    </tbody>
    </thead>
</table>
