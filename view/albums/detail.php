<div class="col-12">
    <div class="row justify-content-center">
        <div class="col-2"><h3>Album: </h3></div>
        <div class="col-7">
            <div class="row">
                <h3 class="col"><?=$alb->get('alb_nom')?></h3>
            </div>
            <div class="row">
                <h3 class="col"><small><?=$alb->get('alb_annee')?> - <?=$alb->get('alb_prix')?>€</small></h3>
            </div>
            <div class="row">
                <h4 class="col"><small>réalisé par </small><a href="./index.php?controller=artistes&action=read&id=<?=$art->get("art_id")?>"><?=$art->get('art_nom')?></a></h4>
            </div>
        </div>
    </div>
</div>