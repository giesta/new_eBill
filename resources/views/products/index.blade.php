@extends('layouts.app')


@section('content')
@if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

        @endif

    <div class="row">

        <div class="col-md-4 offset-md-2">

        

            <div class="pull-left">

                <h2>Produktai</h2>

            </div>

            <div class="pull-right">

                @can('product-create')

                <div>
                    <create-button route="{{ route('products.create') }}">Sukurti</create-button>
                </div>

                @endcan

            </div>

        </div>

    </div>   

<products-table></products-table>


<p class="text-center text-primary"><small>Code of Universe</small></p>

@endsection