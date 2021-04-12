<div class="container">
<div class="row">
<div class="col-md-7">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        
        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['first_name_message'])?' has-error':' has-success'); ?>">
            <label for="first_name">Ім'я: </label>
            <input value="<?php echo !$this->checkForm ? (!empty($this->formValues['first_name']) ? $this->formValues['first_name']:'') : '' ; ?>" type="text" name="first_name" class="form-control" id="first_name" placeholder="Ім'я">
            <span class="help-block"><?php echo !empty($this->formValues['first_name_message'])? $this->formValues['first_name_message']:'';?></span>
        </div>

        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['last_name_message'])?' has-error':' has-success'); ?>">
            <label for="last_name">Прізвище: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['last_name'] : '' ; ?>" type="text" name="last_name" class="form-control" id="last_name" placeholder="Прізвище">
            <span class="help-block"><?php echo !empty($this->formValues['last_name_message'])? $this->formValues['last_name_message']:'';?></span>
        </div>

        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['phone_message'])?' has-error':' has-success'); ?>">
            <label for="phone">Телефон: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['phone'] : '' ; ?>" type="number" name="phone" class="form-control" id="phone" placeholder="Телефон">
            <span class="help-block"><?php echo !empty($this->formValues['phone_message'])? $this->formValues['phone_message']:'';?></span>
        </div>
        
        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['email_message'])?' has-error':' has-success'); ?>">
            <label for="email">E-mail: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['email'] : '' ; ?>" type="email" name="email" class="form-control" id="email" placeholder="E-mail">
            <span class="help-block"><?php echo !empty($this->formValues['email_message'])? $this->formValues['email_message']:'';?></span>
        </div>
        
        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['city_message'])?' has-error':' has-success'); ?>">
            <label for="city">Місто: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['city'] : '' ; ?>" type="text" name="city" class="form-control" id="city" placeholder="Місто">
            <span class="help-block"><?php echo !empty($this->formValues['city_message'])? $this->formValues['city_message']:'';?></span>
        </div>

        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['password_message'])?' has-error':' has-success'); ?>">
            <label for="password">Пароль: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['password'] : '' ; ?>" type="password" name="password" class="form-control" id="password">
            <span class="help-block"><?php echo !empty($this->formValues['password_message'])? $this->formValues['password_message']:'';?></span>
        </div>
        
        <div class="form-group<?php echo $this->checkForm ? '' : (!empty($this->formValues['second_password_message'])?' has-error':' has-success'); ?>">
            <label for="second_password">Повторіть пароль: </label>
            <input value="<?php echo !$this->checkForm ? $this->formValues['second_password'] : '' ; ?>" type="password" name="second_password" class="form-control" id="second_password">
            <span class="help-block"><?php echo !empty($this->formValues['second_password_message'])? $this->formValues['second_password_message']:'';?></span>
        </div>
        
        <input type="submit" value="Sign up" class="btn btn-success" style="margin: 10px 0;">
    </form>   
</div>  
</div> 
</div>  

