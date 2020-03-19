@extends('layouts.app')


@section('content')

<div class="row">

<div class="col-md-4 offset-md-1">
@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif

        <div class="pull-left">

            <h2>Naudotojai</h2>

        </div>
        
        <div>
        <create-button route="{{ route('users.create') }}">Sukurti</create-button>
        </div>
        

    </div>

</div>

<users-table></users-table>

{!! $data->render() !!}


<p class="text-center text-primary"><small>Code of Universe</small></p>

@endsection