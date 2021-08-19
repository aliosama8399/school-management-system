@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('grades.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('sidebar.Grades')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades.add_Grade') }}
                    </button>
                        <button type="button" class="button x-small" id="btn_delete_all">
                            {{ trans('grades.delete_checkbox') }}
                        </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox"
                                           onclick="CheckAll('box1', this)"/></th>
                                <th>#</th>
                                <th>{{trans('grades.Name')}}</th>
                                <th>{{trans('grades.Notes')}}</th>
                                <th>{{trans('grades.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($grades as $grade)
                                <tr>
                                    <?php $i++; ?>
                                        <td><input type="checkbox" value="{{ $grade->id }}" class="box1"></td>
                                        <td>{{ $i }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ trans('grades.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('grades.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{route('Grades.update','test')}}" method="post">
                                                    {{method_field('patch')}}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="Name"
                                                                   class="form-control"
                                                                   value="{{$grade->getTranslation('name', 'ar')}}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $grade->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$grade->getTranslation('name', 'en')}}"
                                                                   name="Name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('grades.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('grades.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('grades.delete_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('Grades.destroy','test')}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    {{ trans('grades.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $grade->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('grades.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('Grades.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>

                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name" required/>
                                                </div>


                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name_en"
                                                           required/>
                                                </div>


                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('grades.Notes') }}
                                                        :</label>
                                                    <textarea class="form-control" name="Notes"
                                                              id="exampleFormControlTextarea1"
                                                              rows="3"></textarea>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button"
                                                           value="{{ trans('My_Classes_trans.delete_row') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                   value="{{ trans('My_Classes_trans.add_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('grades.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('grades.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('grades.delete_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('delete_all_grades') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{ trans('grades.Warning_Grade') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });

    </script>
@endsection
