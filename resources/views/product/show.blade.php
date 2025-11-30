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
                <button type="button" class="btn btn-dark btn-sm btn-round" data-bs-toggle="modal" data-bs-target="#modalFormVarian" id="btnAddVarian">
                    Add Variant
                </button>
            </div>
            <div class="row mt-2">

                @forelse ($product->varian as $item)
                    <div class="col-4">
                        <x-product.card-varian :varian="$item" />
                    </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info" style="box-shadow: none;">
                        <span>No Variants Found. Please Add New Variant</span>
                    </div>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</div>
<x-product.form-varian />
@endsection
@push('script')
<script>
    $(document).ready(function() {
        let modalEl = $('#modalFormVarian');
        let modal = new bootstrap.Modal(modalEl);
        let $form = $('#modalFormVarian form');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnAddVarian').on('click', function () {
            $form.find('[name="_method"]').remove();
            $form[0].reset();
            $form.attr('action', `{{ route('master-data.varian-products.store') }}`);
            $form.find('small.text-danger').text('');
            $('#modalFormVarian .modal-title').text('Add Variant');
            modal.show();
        });


        $('.btnEditVarian').on('click', function () {
            let varian_name = $(this).data('nama-varian');
            let price = $(this).data('price');
            let stock = $(this).data('stock');
            let action = $(this).data('action');
            
            $form[0].reset();
            $form.find('input[name="_token"]').val($('meta[name="csrf-token"]').attr('content'));

            $form.attr('action', action);
            
            $form.append(`<input type="hidden" name="_method" value="PUT">`);
            
            $form.find('input[name="varian_name"]').val(varian_name);
            $form.find('input[name="price"]').val(price);
            $form.find('input[name="stock"]').val(stock);
            $form.find('small.text-danger').text('');
            
            $('#modalFormVarian .modal-title').text('Edit Variant');
            modal.show();
        });


        $form.submit(function (e){
            e.preventDefault();
            let formData = new FormData(this);
            let method = $form.find('input[name="_method"]').val() || $form.attr('method');

            $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response){
                    swal({
                        icon: 'success',
                        title: "Success",
                        text: response.message,
                        timer: 2000,
                    }).then(() => {
                        modal.hide();
                        location.reload();
                    });
                },
                error: function (xhr){
                    let errors = xhr.responseJSON.errors;
                    console.log(errors);

                    $form.find('small.text-danger').text('');
                    $.each(errors, function (key, value){
                        $form.find('[name="' + key + '"]').next('small.text-danger').text(value[0]);
                    });
                }
            })
        });

        $('.formDeleteVarian').submit(function (e){
            e.preventDefault();
            let $this = $(this);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this variant!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: $this.attr('action'),
                        data: $this.serialize(),
                        success: function (response){
                            swal({
                                icon: 'success',
                                title: "Success",
                                text: response.message,
                                timer: 2000,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr){
                            swal("Error deleting variant!", {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush