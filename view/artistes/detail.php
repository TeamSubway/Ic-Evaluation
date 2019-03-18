<div class="col-12">
    <div class="row justify-content-center">
        <div class="col-2"><h3>Artiste: </h3></div>
        <div class="col-7">
            <h3 class="col"><?=$art->get('art_nom')?><br><small></small></h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-2"><h4>Albums: </h4></div>
        <div class="col-7" style="max-height: 300px;overflow: auto">
            <ul class="list-group">
                <?php
                foreach ($alb_list as $alb) { ?>
                    <li class="list-group-item"><a href="./index.php?controller=albums&action=read&id=<?=$alb->get('alb_id')?>"><?=$alb->get('alb_nom')?> <small><?=$alb->get('alb_annee')?> - <?=$alb->get('alb_prix')?>€</small></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>