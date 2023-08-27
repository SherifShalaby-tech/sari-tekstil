<div class="card-body">
    <form action="{{route($url)}}" method="get">
    <div class="row">
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'branch_id',
                    $branches,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.branch')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'employee_id',
                    $employees,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.employee')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'recent_process',
                    $processes,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.recent_process')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'caliber_id',
                    $calibars,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.caliber')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'recent_car_content',
                    $recent_car_contents,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.recent_car_content')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                {!! Form::select(
                    'created_by',
                    $users,null,
                    ['class' => 'form-control select2','placeholder'=>__('lang.created_by')]
                ) !!}
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                <div class="form-check">
                    <input type="hidden" name="empty_carts_val" value="0">
                    <input class="form-check-input" type="checkbox"value="0" name="empty_carts" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      {{__('lang.show_only_empty_carts')}}
                    </label>
                  </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                <div class="form-check">
                    <input type="hidden" name="occupied_carts_val" value="0">
                    <input class="form-check-input" type="checkbox" value="0" name="occupied_carts" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                      {{__('lang.show_only_occupied_carts')}}
                    </label>
                  </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary width-100" title="search">
                    <i class="fa fa-eye"></i> {{ __('Search') }}</button>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
       $("input[name='empty_carts']").click(function(){
            console.log($(this)[0].checked);
            $('input[name="empty_carts_val"]').val($(this)[0].checked);
        });
        $("input[name='occupied_carts']").click(function(){
            console.log($(this)[0].checked);
            $('input[name="occupied_carts_val"]').val($(this)[0].checked);
        });
</script>