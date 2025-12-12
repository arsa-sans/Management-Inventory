@props(['no_sku'])
<div>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-default btn-card-stock text-primary" data-bs-toggle="modal" data-bs-target="#CardStockModal" data-no-sku="{{ $no_sku }}">
    Card Stock 
  </button>

  <!-- Modal -->
  <div class="modal fade" id="CardStockModal" tabindex="-1" aria-labelledby="CardStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="CardStockModalLabel">Card Stock</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table" id="table-card-stock">
            <thead>
              <tr>
                <th>No</th>
                <th>Date</th>
                <th>No Transaction</th>
                <th>Note</th>
                <th>Total Out</th>
                <th>Total In</th>
                <th>Stock</th>
                <th>Officer</th>
              </tr>
            </thead>
            <tbody>
              <!-- Dynamic rows will be inserted here -->
            </tbody>

          </table>
          <div id="pagination-card-stock" class="mt-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
  <script>
    $(document).ready(function () {

      function loadCardStock(NoSku, pageUrl = null) {
        const url = pageUrl || `/card-stock/${NoSku}`;
        const $tbody = $("#table-card-stock tbody");
        const $pagination = $("#pagination-card-stock");
        $tbody.html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');

        $.ajax({
          type: "GET",
          url: url,
          success: function (response) {
            $tbody.empty();
            console.log(response);
            const logger = response.data;
            if (logger.length === 0) {
              $tbody.html('<tr><td colspan="8" class="text-center">No data available</td></tr>');
            }

            logger.forEach((item, index) => {
              const row = `
                <tr>
                  <td>${index + 1}</td>
                  <td>${item.date}</td>
                  <td>${item.no_transaction}</td>
                  <td>${item.type_transaction}</td>
                  <td>${item.total_out ?? '-'}</td>
                  <td>${item.total_in ?? '-'}</td>
                  <td>${item.last_stock}</td>
                  <td>${item.officer}</td>
                </tr>
              `;
              $tbody.append(row);
            });

            if(response.meta.total > response.meta.perPage){
              const meta = response.meta;

              let paginationHtml = '<nav><ul class="pagination justify-content-center gap-1">'
                  meta.links.forEach(link => {
                    const isNumber = /^\d+$/.test(link.label);
                    if(!isNumber) return;

                    paginationHtml += `
                      <li class="page-item">
                        <a class="page-link ${link.active ? 'bg-dark text-white' : ''}" href="${link.url}">
                          ${link.label}
                        </a>
                      </li>
                    `

                    paginationHtml += '</ul></nav>';
                    $pagination.html(paginationHtml);
                  })
            }
          }
        });
      }

      $(document).on("click", ".btn-card-stock", function () {
        let currentNoSku = $(this).data("no-sku");
        loadCardStock(currentNoSku);
      });

    });
  </script>
@endpush