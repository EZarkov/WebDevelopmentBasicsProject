<main>
<div id="forum">
    <ul class="group">
        <li class="group-head">
            <ul>
                <li><?= $data['cat_name']?></li>
                <li>Коментари</li>
                <li>Последен коментар</li>
                <li>Създадена</li>
            </ul>
        </li>
        <?php
        for($i = 0; $i<count($data['topics']);$i++){
        ?>
        <li class="group-body">
            <ul>
                <li>
                    <h3><a href="categoryId<?=$i+1?>">
                            <?=$data['topics'][$i]['name']; ?></a></h3>
                    <span><?=$data['topics'][$i]['substr']?></span>
                </li>
                <li><?=$data['topics'][$i]['comment_count']?></li>
                <li><span style="line-height: 17px">
                    <span class="date-of-last" ><span class="fa fa-clock-o"></span><?=$data['topics'][$i]['last_update']; ?></span>
                    <span class="user-of-last"><span class="fa fa-user"></span><a href="#"><?= $data['topics'][$i]['last_comment_name']?></a></span>
                </span></li>
                <li>
                    <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$data['topics'][$i]['date']; ?></span>
                    <span class="user-of-last"><span class="fa fa-user"></span><a href="#"><?= $data['username']?></a></span>
                </li>

            </ul>
        <?php
        }
        ?>
        <li class="group-foot"></li>
    </ul>
</div>
</main>
