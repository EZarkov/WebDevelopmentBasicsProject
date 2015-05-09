<main>
<div id="forum">
    <ul class="group">
        <li class="group-head">
            <ul>
                <li><?= $this->data['title']?></li>
                <li>Коментари</li>
                <li>Последен коментар</li>
                <li>Създадена</li>
            </ul>
        </li>
        <?php
		foreach ($this->data['posts'] as $post) {


        ?>
        <li class="group-body">
            <ul>
                <li>
                    <h3><a href="/index/showPost/<?=$post['id']?>">
                            <?= $post['title'] ?></a></h3>
                    <span><?=substr($post['text'], 0, 50) ?>...</span>
                </li>
                <li><?=count($post['answers'])?></li>
                <li><span style="line-height: 17px">
                    <span class="date-of-last" ><span class="fa fa-clock-o"></span><?=$post['answers'][0]['created']; ?></span>
                    <span class="user-of-last"><span class="fa fa-user"></span><a href="#"><?= $post['answers'][0]['user']?></a></span>
                </span></li>
                <li>
                    <span class="date-of-last"><span class="fa fa-clock-o"></span><?=$post['created']; ?></span>
                    <span class="user-of-last"><span class="fa fa-user"></span><a href="#"><?= $post['user']?></a></span>
                </li>

            </ul>
        <?php
        }
        ?>
        <li class="group-foot"></li>
    </ul>
</div>
</main>
