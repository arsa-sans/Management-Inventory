@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
<div class="card">
  <div class="card-body py-5">

    <div class="row">
    
      <div class="row col-10">

        <div class="col-1">
          <x-per-page-option />
        </div>
      
        <div class="col-9">
          <x-filter-by-field term="search" placeholder="Search Category..." />
        </div>

        <div class="col-1">
          <x-button-reset-filter route="master-data.categories.index" />
        </div>

      </div>

      <div class="col-2 d-flex justify-content-end">
        <x-category.form-category-products :action="$action" />
      </div>

    </div>

    <table class="table mt-5">
      <thead>
        <tr>
          <th class="text-center" style="widht: 15px">No</th>
          <th>Name Category</th>
          <th class="text-center" style="widht: 100px">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($categories as $index => $item)
        <tr>
          <td class="text-center">{{ $index + 1 }}</td>
          <td>{{ $item->name }}</td>
          <td>
            <div class="d-flex justify-content-center gap-2">
              <x-category.form-category-products :id="$item->id" :action="route('master-data.categories.update', $item)" :name="$item->name" />
              <x-confirm-delete id="{{ $item->id }}" route="master-data.categories.destroy" />
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center">No Categories Found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{ $categories->links() }}
  </div>
</div>
@endsection