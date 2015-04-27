<main>
<div id="forum">
<ul class="group">
    <li class="group-head">
        <ul>
            <li>Правила</li>
            <li>Теми</li>
            <li>Мнения</li>
            <li>Последно</li>
        </ul>
    </li>
    <?php
    foreach ($data['system'] as $lang=>$info):
    ?>
    <li class="group-body">
        <ul>
            <li>
                <h3><a href="" class="category" id="<?=$info['category_id']?>"><?=$lang?></a></h3>
                <span>Всичко свързано с езика <?=$lang?></span>
            </li>
            <li><?=$info['topic_count']?></li>
            <li><?=$info['comment_count']?></li>
            <li>
                <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$info['last_comment_date']?></span>
                <span class="user-of-last"><span class="fa fa-user"></span> <a href="#"><?=$info['user_id']?></a></span>
            </li>
        </ul>
    </li>
    <?php endforeach ?>
    <li class="group-foot"></li>
</ul>
<ul class="group">
    <li class="group-head">
        <ul>
            <li>ООП езици</li>
            <li>Теми</li>
            <li>Мнения</li>
            <li>Последно</li>
        </ul>
    </li>
    <?php
    foreach ($data['oop'] as $lang=>$info):
    ?>
    <li class="group-body">
        <ul>
            <li>
                <h3><a href="" class="category" id="<?=$info['category_id']?>"><?=$lang?></a></h3>
                <span>Всичко свързано с езика <?=$lang?></span>
            </li>
            <li><?=$info['topic_count']?></li>
            <li><?=$info['comment_count']?></li>
            <li>
                <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$info['last_comment_date']?></span>
                <span class="user-of-last"><span class="fa fa-user"></span> <a href="#"><?=$info['user_id']?></a></span>
            </li>
        </ul>


    </li>
    <?php endforeach ?>
    <li class="group-foot"></li>
</ul>
<ul class="group">
    <li class="group-head">
        <ul>
            <li>Функционални езици</li>
            <li>Теми</li>
            <li>Мнения</li>
            <li>Последно</li>
        </ul>
    </li>
    <?php
    foreach ($data['func'] as $lang=>$info):
    ?>
    <li class="group-body">
        <ul>
            <li>
                <h3><a href="" class="category" id="<?=$info['category_id']?>"><?=$lang?></a></h3>
                <span>Всичко свързано с езика <?=$lang?></span>
            </li>
            <li><?=$info['topic_count']?></li>
            <li><?=$info['comment_count']?></li>
            <li>
                <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$info['last_comment_date']?></span>
                <span class="user-of-last"><span class="fa fa-user"></span> <a href="#"><?=$info['user_id']?></a></span>
            </li>
        </ul>
    </li>
    <?php endforeach ?>
    <li class="group-foot"></li>
</ul>
<ul class="group">
    <li class="group-head">
        <ul>
            <li>Извратени езици</li>
            <li>Теми</li>
            <li>Мнения</li>
            <li>Последно</li>
        </ul>
    </li>
    <?php
    foreach ($data['strange'] as $lang=>$info):
        ?>
        <li class="group-body">
            <ul>
                <li>
                    <h3><a href="" class="category" id="<?=$info['category_id']?>"><?=$lang?></a></h3>
                    <span>Всичко свързано с езика <?=$lang?></span>
                </li>
                <li><?=$info['topic_count']?></li>
                <li><?=$info['comment_count']?></li>
                <li>
                    <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$info['last_comment_date']?></span>
                    <span class="user-of-last"><span class="fa fa-user"></span> <a href="#"><?=$info['user_id']?></a></span>
                </li>
            </ul>
        </li>
    <?php endforeach ?>
    <li class="group-foot"></li>
</ul>
</div>
</main>