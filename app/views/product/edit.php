
<div class="container">
<div class="row">
<div class="col-md-7">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        
        <div class="<?php echo $this->registry['saved'] == 1 || $this->addToEdit == true ? "alert alert-success" : "" ?>" role="alert" style="padding: 7px 15px 7px"><?php echo $this->registry['saved'] == 1 || $this->addToEdit == true ? "Товар успішно збережено!" : ""?></div>
        
        <input type="hidden" name="id" value="<?php echo $this->registry['product']['id'] ?>">
        
        <div class="form-group<?php echo !empty($this->registry['product']['sku_message'])?' has-error':' has-success'; ?>">
            <label for="sku">Sku: </label>
            <input value="<?php echo $this->registry['product']['sku']; ?>" type="text" name="sku" class="form-control" id="sku" placeholder="Код товару">
            <span class="help-block"><?php echo !empty($this->registry['product']['sku_message'])? $this->registry['product']['sku_message']:'';?></span>
        </div>

        <div class="form-group<?php echo !empty($this->registry['product']['name_message'])? ' has-error' : ' has-success'; ?>">
            <label for="name">Name: </label>
            <input value="<?php echo $this->registry['product']['name']; ?>" type="text" name="name" class="form-control" id="name" placeholder="Назва товару">
            <span class="help-block"><?php echo !empty($this->registry['product']['name_message'])? $this->registry['product']['name_message']:'';?></span>
        </div>

        <div class="form-group<?php echo !empty($this->registry['product']['price_message']) ? ' has-error' : ' has-success'; ?>">
            <label for="price">Price: </label>
            <input value="<?php echo $this->registry['product']['price']; ?>" type="number" name="price" class="form-control" id="price" placeholder="Ціна">
            <span class="help-block"><?php echo !empty($this->registry['price_message'])? $this->registry['price_message']:'';?></span>
        </div>

        <div class="form-group<?php echo !empty($this->registry['product']['qty_message']) ? ' has-error':' has-success' ; ?>">
            <label for="qty">Qty: </label>
            <input value="<?php echo $this->registry['product']['qty']; ?>" type="number" name="qty" class="form-control" id="qty" placeholder="Кількість">
            <span class="help-block"><?php echo !empty($this->registry['qty_message'])? $this->registry ['qty_message']:'';?></span>
        </div>

        <div>
            <label for="description">Характеристики: </label>
            <br>
            <textarea class="form-control" maxlength="500" name="description">
            <?php echo $this->registry['product']['description'] ?>
            </textarea>
        </div>
        
        <input type="submit" value="Редагувати" class="btn btn-success" style="margin: 10px 0;">
    </form>   
</div>  
</div> 
</div>  
