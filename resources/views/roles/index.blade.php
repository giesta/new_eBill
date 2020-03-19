@extends('layouts.app')


@section('content')

<div class="row">

<div class="col-md-4 offset-md-2">


@if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>

@endif
        <div class="pull-left">

            <h2>Rolės</h2>

        </div>

        <div class="pull-right">

        @can('role-create')

        <div>
        <create-button route="{{ route('roles.create') }}"></create-button>
        </div>

            @endcan

        </div>

    </div>

</div>

<roles-table></roles-table>

{!! $roles->render() !!}


<p class="text-center text-primary"><small>Code of Universe</small></p>

@endsection