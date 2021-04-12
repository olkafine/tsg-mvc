<div class="container">
    <div class="row">
        <div class="col-md-11"> 

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="width:70%" class="panel-title pull-left"><b>Please Login</b></h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        
                        <?php if ($this->invalid_password == 1) :?>
                        <div class="alert alert-danger" role="alert">Невірно введений e-mail або пароль!</div>
                        <?php endif; ?>
                        
                        <div class="form-group<?php echo $this->invalid_password == 1 ? ' has-error' : ''; ?>">
                            <label for="email">E-mail: </label>
                            <input value="<?php echo $this->registry['customer']['email']; ?>" type="text" name="email" class="form-control" id="email" placeholder="Enter E-Mail">
                        </div>
                        <div class="form-group<?php echo $this->invalid_password == 1 ? ' has-error' : ''; ?>">
                            <label for="password">Password: </label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                        </div>
                        <input type="submit" value="Login" class="btn btn-success" style="margin: 10px 0;">
                    </form>   
                </div>
            </div>  
        </div>
    </div>
</div>
