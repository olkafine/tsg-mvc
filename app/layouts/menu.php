<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php 
        $menu = Helper::getMenu();
        foreach($menu as $item)  :
            if (($item['admin_access'] == 1 && Helper::isAdmin() == 1)||$item['admin_access'] == 0) :
    ?>
                <li>
                    <?php 
                        echo Helper::simpleLink($item['path'], $item['name']); 
                    ?>  
                </li>
    <?php 
            endif;
        endforeach; 
    ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <?php if (!empty($this->registry['customer'])) : ?>
        <li><a href="<?php echo route::getBP();?>/index/index/"><span class="glyphicon glyphicon-user"></span><?php echo " " . $this->registry['customer']['last_name'] . " " . $this->registry['customer']['first_name']  ?></a></li>
        <li><a href="<?php echo route::getBP();?>/customer/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        
        <?php else : ?>
        <li><a href="<?php echo route::getBP();?>/customer/signup/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="<?php echo route::getBP();?>/customer/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif; ?>
    </ul>
  </div>
</nav>