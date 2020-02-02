@extends('layouts.app')


@section('content')

<div class="row">

<div class="col-md-4 offset-md-2">

        <div class="pull-left">

            <h2>Rolės</h2>

        </div>

        <div class="pull-right">

        @can('role-create')

        <div>
        <create-button route="{{ route('roles.create') }}">Sukurti</create-button>
        </div>

            @endcan

        </div>

    </div>

</div>


@if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>

@endif



<roles-table></roles-table>

{!! $roles->render() !!}


<p class="text-center text-primary"><small>Code of Universe</small></p>

@endsection