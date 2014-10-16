<li class="item">
    <a href="/news/<?=$data->alias?>"><img src="/media/news.png" alt="" title=""></a>
    <div >
        <span class="data"><?=date('d.m.Y',strtotime($data->create_time))?></span>
        <a href="/news/<?=$data->alias?>" class="name">
            <?=$data->description?>
        </a>
    </div>
</li>