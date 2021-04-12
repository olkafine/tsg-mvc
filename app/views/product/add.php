<div class="container">
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['sku_message']) ? ' has-error' : ' has-success'); ?>">
                    <label for="sku">Sku: </label>
                    <input value="<?php echo!$this->checkForm ? (!empty($this->formValues['sku']) ? $this->formValues['sku'] : '') : ''; ?>" type="text" name="sku" class="form-control" id="sku" placeholder="Код товару">
                    <span class="help-block"><?php echo!empty($this->formValues['sku_message']) ? $this->formValues['sku_message'] : ''; ?></span>
                </div>

                <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['name_message']) ? ' has-error' : ' has-success'); ?>">
                    <label for="name">Name: </label>
                    <input value="<?php echo!$this->checkForm ? $this->formValues['name'] : ''; ?>" type="text" name="name" class="form-control" id="name" placeholder="Назва товару">
                    <span class="help-block"><?php echo!empty($this->formValues['name_message']) ? $this->formValues['name_message'] : ''; ?></span>
                </div>

                <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['price_message']) ? ' has-error' : ' has-success'); ?>">
                    <label for="price">Price: </label>
                    <input value="<?php echo!$this->checkForm ? $this->formValues['price'] : ''; ?>" type="number" name="price" class="form-control" id="price" placeholder="Ціна">
                    <span class="help-block"><?php echo!empty($this->formValues['price_message']) ? $this->formValues['price_message'] : ''; ?></span>
                </div>

                <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['qty_message']) ? ' has-error' : ' has-success'); ?>">
                    <label for="qty">Qty: </label>
                    <input value="<?php echo!$this->checkForm ? $this->formValues['qty'] : ''; ?>" type="number" name="qty" class="form-control" id="qty" placeholder="Кількість">
                    <span class="help-block"><?php echo!empty($this->formValues['qty_message']) ? $this->formValues['qty_message'] : ''; ?></span>
                </div>

                <div>
                    <label for="description">Характеристики: </label>
                    <br>
                    <textarea class="form-control" maxlength="500" name="description"></textarea>
                </div>

                <input type="submit" value="Додати" class="btn btn-success" style="margin: 10px 0;">
            </form>   
        </div>  
    </div> 
</div>  