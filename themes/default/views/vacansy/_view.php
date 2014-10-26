<li class="<?=$acive ? 'active' : ''?>">
    <a href="/vacansy/view?id=<?=$data->id?>">
        <?=$data->post?>
    </a>
    <div class="inf">
            <dl>
                <dt>
                    Условия работы:
                </dt>
                <dd>
                    <?=$data->conditions_work?>
                </dd>
                <dt>
                    Навыки:
                </dt>
                <dd>
                    <?=$data->skill?>
                </dd>
                <dt>
                    Мы предлагаем:
                </dt>
                <dd>
                    <?=$data->condition_our?>
                </dd>
            </dl>
            <p>
                <?=$data->desc?>
            </p>    
        </div>
</li>