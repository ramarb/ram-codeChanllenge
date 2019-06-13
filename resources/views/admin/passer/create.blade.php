@extends('admin.main')

@section('content')

    <style>

    </style>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Examinee</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
    </div>

    <div class="card">
        <div class="card-header">
            Create
        </div>
        <div class="card-body">
            <form style="margin-top: 10px" action="{{url('admin/' . $controller . '')}}" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fullname</label>
                    <input type="text" class="form-control" name="full_name" id="" placeholder="" autocomplete="off" required>
                    <div class="invalid-feedback">
                        Please add a fullname.
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">School</label>
                    <select class="form-control" name="school_id" required>
                        <option value="">Select a School</option>
                        @foreach(\App\Model\School::all() as $obj)
                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please add a School.
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Division</label>
                    <select class="form-control" name="division_id" required>
                        <option value="">Select a Division</option>
                        @foreach(\App\Model\Division::all() as $obj)
                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please add a School.
                    </div>
                </div>



                <div class="float-lg-right" style="margin-bottom: 20px">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="#" id="back-button" class="btn btn-secondary">Back</a>
                </div>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

        })

    </script>


@endsection
