<div>
  <!-- Modal -->
  <div class="modal fade" id="modalFormVarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormVarianLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="POST" endctype="multipart/form-data" action="{{ $action }}">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalFormVarianLabel">Form Varian</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="varian_name" class="form-label">Varian Name</label>
              <input type="text" name="varian_name" id="varian_name" class="form-control" placeholder="Varian Name" value="{{ old('varian_name', $varian_name ?? '') }}">
              <small class="text-danger"></small>
            </div>
            <div class="form-group">
              <label for="price" class="form-label">Price</label>
              <input type="number" name="price" id="price" class="form-control" placeholder="Varian Name" value="{{ old('price', $price ?? '') }}">
              <small class="text-danger"></small>
            </div>
            <div class="form-group">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" name="stock" id="stock" class="form-control" placeholder="Varian Name" value="{{ old('stock', $stock ?? '') }}">
              <small class="text-danger"></small>
            </div>
            <div class="form-group">
              <label for="image" class="form-label">Image</label>
              <input type="file" name="image" id="image" class="form-control" placeholder="Varian Name">
              <small class="text-danger"></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>