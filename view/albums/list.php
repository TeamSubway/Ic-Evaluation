<ul class="list-group">
<?php
foreach ($alb_list as $alb) { ?>
    <li class="list-group-item"><a href="./index.php?controller=albums&action=read&id=<?=$alb->get('alb_id')?>"><?=$alb->get('alb_nom')?> <small><?=$alb->get('alb_annee')?> - <?=$alb->get('alb_prix')?>€</small></a></li>
<?php } ?>
</ul>
