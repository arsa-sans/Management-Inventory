@extends('layouts.kai')
@section('title', $pageTitle)
@section('content')
  <div class="card">
    <div class="card-body py-5">
      <div class="row align-items-center">
        <div class="row col-10">
          <div class="col-1">
            <x-per-page-option />
          </div>
        
          <div class="col-8">
            <x-filter-by-field term="search" placeholder="Search Product..." />
          </div>

          <div class="col-2">
            <x-button-reset-filter route="master-data.products.index" />
          </div>
        </div>

        <div class="row col-2 d-flex justify-content-end">
          <x-product.form-product :action="$action" :category="$categories" />
        </div>
      </div>
      <table class="table mt-5">
        <thead>
          <tr>
            <th class="text-center" style="width: 15px">No</th>
            <th>Name</th>
            <th>Category</th>
            <th class="text-center" style="width: 10px">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $index => $item)
            <tr>
              <td>{{ $index + 1}}</td>
              <td>
                <a href="{{ route('master-data.products.show', $item->id) }}" class="text-decoration-none">
                  {{ $item->name }}
                </a>
              </td>
              <td>{{ optional($item->category)->name ?? 'Uncategorized' }}</td>
              <td class="d-flex align-items-center gap-1">
                <x-product.form-product 
                  :id="$item->id" 
                  :action="route('master-data.products.update', $item->id)" 
                  :name="$item->name" 
                  :category_id="$item->category_id" 
                  :description="$item->description"
                  :category="$categories"
                />
                <x-confirm-delete id="{{ $item->id }}" route="master-data.products.destroy" /> 
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No data available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection