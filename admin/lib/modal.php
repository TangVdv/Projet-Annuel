<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalCenteredScrollableTitle" translate-key="informationproduct-title"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-center">
      <table class='table table-striped'>
        <thead class='text-center'>
          <tr>
            <th translate-key="image-title"></th>
            <th translate-key="name-title"></th>
            <th translate-key="desc-title"></th>
            <th translate-key="price-title"></th>
            <th translate-key="discount-title"></th>
            <th translate-key="stock-title"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            
          </tr>
        </tbody>
      </table>
    </div>
    <div class="modal-footer justify-content-between">
      <div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" translate-key="cancel-button"></button>
      </div>
      <div class="d-flex">
        <div class="mx-4">
          <button type="button" class="btn btn-primary" id="modify_submit" name=<?php echo $row->id_produit; ?> translate-key="modify-button"></button>
        </div>
        <div>
          <form action=<?php echo "checkProduct.php?id=".$row->id_produit; ?> method="post">
            <button type="submit" class="btn btn-danger" name="delete_submit" translate-key="delete-button"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
