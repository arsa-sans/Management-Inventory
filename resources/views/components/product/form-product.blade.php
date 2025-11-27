@props(['id' => null, 'action' => '', 'category' => [], 'category_id' => null, 'name' => '', 'description' => ''])

<div>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-icon' : 'btn-dark'}}" data-bs-toggle="modal" data-bs-target="#FormProduct{{ $id ?? '' }}">
  @if ($id)
    <i class="fas fa-edit"></i>
  @else
    <span class="btn-label">
      <i class="fas fa-plus"></i>
    </span>
    Add Product
  @endif
</button>

<!-- Modal -->
<div class="modal fade" id="FormProduct{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FormProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ $action }}" method="POST">
        @csrf
        @if ($id)
          @method('PUT')
        @endif
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="FormProductLabel">Form Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="category_id" class="form-label">Category Product</label>
            <select name="category_id" id="category_id" class="form-control">
              <option value="">Chose Category</option>
              @foreach ($category as $cat)
                <option value="{{ $cat->id }}"
                  {{ old('category_id', $category_id ?? '') == $cat->id ? 'selected' : '' }}
                >{{ $cat->name }}</option>
              @endforeach
            </select>
            @error('category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="name" class="form-label">Name Product</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $name ?? '') }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control">
              {{ old('description', $description ?? '') }}
            </textarea>
            @error('description')
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