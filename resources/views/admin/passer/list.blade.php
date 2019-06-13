@extends('admin.main')

@section('content')
    @include('admin.content.findnreplace')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$mgt_name}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>

    </div>

    <nav class="navbar-expand-lg" size="" style="padding: 5px 0">
        <a class="btn btn-primary" href="{{url('admin/' . $controller . '/create')}}">Create</a>
        @include('admin.search')
    </nav>



    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>

                {!! html_entity_decode($header) !!}
            </tr>
            </thead>
            <tbody>
                @if(\App\Model\Passer::count() > 0)
                    @foreach($rec as $row)
                        <tr>
                            <td>{{$row->full_name}}</td>
                            <td>{{$row->school->name}}</td>
                            <td>{{$row->division->name}}</td>

                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>

                        </tr>
                    @endforeach
                @endif

            </tbody>


        </table>
    </div>

    <div>
        {{$rec->links('vendor.pagination.bootstrap-4')}}
    </div>




@endsection