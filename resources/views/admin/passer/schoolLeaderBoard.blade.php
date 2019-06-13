@extends('admin.main')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">School Leader Board</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>

    </div>





    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <td>School</td>
                <td>Number of passers</td>
            </tr>
            </thead>
            <tbody>
                @if(\App\Model\School::count() > 0)
                    @foreach(\App\Model\School::getPasserCount() as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->ctr}}</td>

                        </tr>
                    @endforeach
                @endif

            </tbody>


        </table>
    </div>






@endsection