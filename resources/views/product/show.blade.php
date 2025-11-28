@extends('layouts.kai')
@section('title', $pageTitle)
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Detail : {{ $product->name }}</h4>
        <a href="{{ route('master-data.products.index') }}" class="text-primary">Back</a>
    </div>
    <div class="card-body">
        <x-meta-item label="Name" :value="$product->name" />
        <x-meta-item label="Category" :value="optional($product->category)->name ?? 'Uncategorized'" />
        <x-meta-item label="Description" :value="$product->description ?? '-'" />
        <div class="mt-2">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-dark btn-sm btn-round" data-bs-toggle="modal" data-bs-target="#modalFormVarian">
                    Add Variant
                </button>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info" style="box-shadow: none;">
                        <span>No Variants Found. Please Add New Variant</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-product.form-varian />
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#modalFormVarian').on('shown.bs.modal', function () {
            $('#varian_name').trigger('focus');
        });
    });
</script>
@endpush