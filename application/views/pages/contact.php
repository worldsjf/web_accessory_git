<div class="container">
    <div class="row">
        <div class="md-col-12 notfound">
            <h4>
                Xin hãy để lại thông tin. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất
            </h4>
            <form action="<?php echo base_url('thanks-contact')?>" method="POST">
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label for="validationDefault01">Họ và tên</label>
          <input type="text" class="form-control" id="validationDefault01"  required>
        </div>
        <div class="col-md-12 mb-3">
          <label for="phone">Số Điện Thoại</label>
          <input type="text" class="form-control" id="phone" required>
        </div>
      
        <div class="col-md-12 mb-3">
          <label for="validationDefault03">Địa chỉ</label>
          <input type="text" class="form-control" id="validationDefault03"  required>
        </div>
        <div class="col-md-12 mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email"   required>
        </div>
        <div class="col-md-12 mb-3">
          <label for="product">Sản Phẩm Quan Tâm</label>
          <input type="text" class="form-control" id="product"   required>
        </div>
      
      
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
        </div>
    </div>
</div>