@extends('layouts.kai')

@section('title', 'Edit Variant')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Varian: {{ $varianProduct->varian_name }}</h4>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- The form-varian component is already designed to handle editing --}}
                {{-- It populates fields and sets the correct update action when an 'id' is passed --}}
                <x-product.form-varian :id="$varianProduct->id" />
            </div>
        </div>
    </div>
</div>
@endsection
