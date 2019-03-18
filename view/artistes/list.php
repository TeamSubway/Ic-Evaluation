<ul class="list-group">
    <?php
    foreach ($list_artiste as $value) { ?>
        <li class="list-group-item"><a href="./index.php?controller=artistes&action=read&id=<?=$value->get('art_id')?>"><?=$value->get('art_nom') ?></a></li>

    <?php } ?>
</ul>
