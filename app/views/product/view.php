<div class="container">
    <div class="row">
        <div class="col-md-11"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="width:70%" class="panel-title pull-left"><b><?php echo $this->registry['product']['name'] ?></b></h3>
                    <?php if (Helper::isAdmin() == 1) : ?>
                        <a 
                            onclick="return confirm('Підтвердити видалення?')"
                            style="margin: 0 5px" 
                            class="pull-right" 
                            title="Видалити" 
                            href="<?php echo Helper::link('/product/delete', array('id' => $this->registry['product']['id'])); ?>"
                            >
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" >

                            </span>
                        </a>
                        <a 
                            class="pull-right" 
                            title="Редагувати" 
                            href="<?php echo Helper::link('/product/edit', array('id' => $this->registry['product']['id'])); ?>"
                            >
                            <span class="glyphicon glyphicon-edit" aria-hidden="true">

                            </span>
                        </a>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <img   class="img-thumbnail pull-right" style="width: 120px; height: 120px; margin: 10px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNmUzMGVhZWQwZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2ZTMwZWFlZDBlIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzQuNSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==">

                    <div style="margin: 4px 0 0 7px ">

                        <div class="col-md-6 pull-left">
                            <p class="sku"><b>Код: </b><?php echo $this->registry['product']['sku'] ?></p>
                            <p> <b>Ціна:</b> <span class="price"><?php echo $this->registry['product']['price'] ?></span> грн</p>
                            <p> <b>Кількість:</b> <?php echo $this->registry['product']['qty'] ?></p>

                            <p><?php
                                if (!$this->registry['product']['qty'] > 0) {
                                    echo 'Нема в наявності';
                                }
                                ?></p>
                        </div>



                        <div class="col-md-8 pull-left">
                            <b><p>Характеристика: </p></b>
                            <p>
                                <?php echo $this->registry['product']['description'] ?>
                            </p>
                        </div>


                    </div>


                </div>
            </div>  
        </div>
    </div>
</div>

<a class="btn btn-success pull-left" 
   href="<?php echo Helper::link('/product/list'); ?>" 
   style="margin-left: 5px;">Назад</a>

