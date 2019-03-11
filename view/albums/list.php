<ul class="list-group">
<?php
foreach ($alb_list as $alb) { ?>
    <li class="list-group-item"><?=$alb->get('alb_nom')?> <small><?=$alb->get('alb_annee')?> - <?=$alb->get('alb_prix')?>€</small></li>
<?php } ?>
</ul>
