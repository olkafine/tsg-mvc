<?php
if (!empty($this->registry['customer'])) : ?>
    <h3>Вітаю, <?php echo $this->registry['customer']['first_name']?>!</h3>
<?php else : ?>
    <h3>Вітаю, незареєстрований користувач!</h3>
<?php endif; ?>
