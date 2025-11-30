<div class="card">
  <div class="card-body">
    <img src="{{ asset('storage/varian-product/'. $varian->image) }}" alt="{{ $varian->varian_name }}" class="img-fluid mb-2" style="max-height: 300px; object-fit: cover; width: 100%; height: 100%;"/>
    <h5 class="card-title">{{ $varian->varian_name }}</h5>
    <x-meta-item label="No SKU" value="{{ $varian->no_sku }}" />
    <x-meta-item label="Price" value="Rp. {{ number_format($varian->price, 0, ',', '.') }}" />
    <x-meta-item label="Stock" value="{{ number_format($varian->stock) }} pcs" />
  </div>
  <div class="card-footer d-flex justify-content-between align-items-center gap-1">
    <div class="w-100">
      <button type="button" class="btn btn-outline-primary btn-sm btnEditVarian" data-id="{{ $varian->id }}" data-nama-varian="{{ $varian->varian_name }}" data-price="{{ $varian->price }}" data-stock="{{ $varian->stock }}" data-action="{{ route('master-data.varian-products.update', $varian->id) }}">
        Edit
      </button>
    </div>
    <form action="{{ route('master-data.varian-products.destroy', $varian->id) }}" method="POST" class="formDeleteVarian">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-outline-danger btn-sm btnDeleteVarian">
        Delete
      </button>
    </form>
  </div>
</div>