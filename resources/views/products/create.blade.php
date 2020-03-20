@extends('layouts.app')


@section('content')



    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    

    <div class="row justify-content-center">

    

    <div class="col-xs-8 col-sm-8 col-md-8 ml-4">
    <product-create></product-create>
    </div>

</div>


<p class="text-center text-primary"><small>Code of Universe</small></p>

@endsection