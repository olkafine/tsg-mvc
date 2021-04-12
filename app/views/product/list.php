<?php if (Helper::isAdmin() == 1) :?>
<a class="btn btn-warning pull-left" href="<?php echo Helper::link('/product/unload'); ?>" style="margin-left: 5px; margin-bottom: 5px;">Експорт в XML</a>

<div class="clearfix"></div>
<a class="btn btn-success pull-left" href="<?php echo Helper::link('/product/add'); ?>" style="margin-left: 5px;">Додати товар</a>
<?php endif; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>"  class="form-inline pull-right">
    <select name='sort' class="form-control pull-right"  >
        <option <?php echo $this->sort === 'price_ASC' ? 'selected' : ''; ?> value="price_ASC">від дешевших до дорожчих</option>
        <option <?php echo $this->sort === 'price_DESC' ? 'selected' : ''; ?> value="price_DESC">від дорожчих до дешевших</option>
        <option <?php echo $this->sort === 'qty_ASC' ? 'selected' : ''; ?>  value="qty_ASC">по зростанню кількості</option>
        <option <?php echo $this->sort === 'qty_DESC' ? 'selected' : ''; ?>  value="qty_DESC">по спаданню кількості</option>
    </select>
    <br>
    <div style="display: inline-block; margin-top: 5px;">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Ціна від: </span>
        <input type="text" name="from" class="form-control" placeholder="0" aria-describedby="basic-addon1"
               style="width: 150px;"
               value="0">
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">до: </span>
        <input type="text" name="to" class="form-control" placeholder="100000" aria-describedby="basic-addon1"
               style="width: 150px; " 
               value="<?php echo $this->registry['maxprice']; ?>">
    </div>
    
    <input type="submit" value="Застосувати" class="btn btn-primary" >  
    </div>
</form>
<div class="clearfix"></div>
<br> 
<div class="container">
    <div class="row">

        <?php
        $products = $this->registry['products'];

        foreach ($products as $product) :
        ?>

        <div class="col-md-4"> 
                
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="width:70%" class="panel-title pull-left">
                            <a href="<?php echo Helper::link('/product/view', array('id' => $product['id'])); ?>">
                            <b><?php echo $product['name'] ?></b>
                            </a>
                    </h3>
                    <?php if (Helper::isAdmin() == 1 ) :?>
                    <a 
                        onclick="return confirm('Підтвердити видалення?')"
                        style="margin: 0 5px" 
                        class="pull-right" 
                        title="Видалити" 
                        href="<?php echo Helper::link('/product/delete', array('id' => $product['id'])); ?>"
                    >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true" >
                        
                    </span>
                    </a>
                    <a 
                        class="pull-right" 
                        title="Редагувати" 
                        href="<?php echo Helper::link('/product/edit', array('id' => $product['id'])); ?>"
                    >
                    <span class="glyphicon glyphicon-edit" aria-hidden="true">
                        
                    </span>
                    </a>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <img   class="img-thumbnail pull-left" style="width: 120px; height: 120px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNmUzMGVhZWQwZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2ZTMwZWFlZDBlIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzQuNSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==">
                    <div class="pull-left" style="margin: 4px 0 0 7px ">
                        <p class="sku">Код: <?php echo $product['sku'] ?></p>
                        <p> Ціна: <span class="price"><?php echo $product['price'] ?></span> грн</p>
                        <p> Кількість: <?php echo $product['qty'] ?></p>
                        
                        <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" 
                                data-content='<?php echo strip_tags($product['description']) ?>'>
                                Характеристика
                        </button>

                        <p><?php if (!$product['qty'] > 0) {
                            echo 'Нема в наявності';
                        } ?></p>
                    </div>
                </div>
            </div>  
                
        </div>
        
        <?php endforeach; ?>

    </div>
</div>


<script> 
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>