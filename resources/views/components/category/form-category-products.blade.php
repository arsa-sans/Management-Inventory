@props(['id' => null, 'action' => '', 'name' => ''])

<div>
  <button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-bs-toggle="modal" data-bs-target="#formCategory{{ $id ?? '' }}">
    @if($id)
      <i class="fa fa-edit"></i>
    @else
      <span class="btn-label">
        <i class="fa fa-plus"></i>
      </span>
      Add Category
    @endif
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="formCategory{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ $action }}" method="POST">
          @csrf
          @if($id)
            @method('PUT')
          @endif
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="formCategoryLabel">Form Category Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name" class="form-label">Name Category</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $name }}" value="{{ old('name', $name ?? '') }}">
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>