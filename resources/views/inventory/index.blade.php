@extends('layouts.kai')
@section('title', $pageTitle)
@section('content')
  <div class="card">
    <div class="card-body py-5 mt-5">
      <div class="row align-items-center">
        <div class="row col-9 justify-content-between">
          <div class="col-1">
            <x-per-page-option />
          </div>
          <div class="col-8">
            <x-filter-by-field term="search" placeholder="Search Product..." />
          </div>
          <div class="col-2">
            <x-filter-by-option 
              :options="$category" 
              term="category" 
              defaultValue="Filter by Category" 
              field="name" 
            />
          </div>
        </div>
        <div class="col-2"></div>
        <div class="col-1">
          <x-button-reset-filter route="master-data.inventories.index" />
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" style="width: 15px;">No</th>
            <th>SKU</th>
            <th>Product</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Card Stock</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($product as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item['no_sku'] }}</td>
              <td>{{ $item['product_name'] }}</td>
              <td>{{ $item['category_name'] }}</td>
              <td>{{ $item['stock'] }} pcs</td>
              <td>Rp. {{ number_format($item['price']) }}</td>
              <td>
                <x-card-stock no_sku="{{ $item['no_sku'] }}" />
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No inventory found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
