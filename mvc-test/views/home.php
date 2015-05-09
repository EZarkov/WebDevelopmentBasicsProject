<main>
	<div id="forum">
		<?php
		//echo '<pre>' . print_r($this->data, true) . '</pre>';

		foreach ($this->data as $category):
			?>
			<ul class="group">
				<li class="group-head">
					<ul>
						<li><?= $category['title']?></li>
						<li>&nbsp; </li>
						<li>Мнения</li>
						<li>Последно</li>
					</ul>
				</li>
				<?php
				foreach ($category['topics'] as $topic) {
					?>
					<li class="group-body">
						<ul>
							<li>
								<h3><a href="\index\showTopic\<?= $topic['id']. "/" . $topic['title']?>" class="category" id="<?= $category['id'] ?>"><?= $topic['title'] ?></a>
								</h3>
								<?php if($topic['description'] != '') {
									echo "<span>" . $topic['description'] ."</span>";
								}
								 else {
								echo "<span>Всичко свързано с езика ". $topic['title'] ."</span>";
								}?>
							</li>
							<li>&nbsp; </li>
							<li><?= $topic['count'] ?></li>
							<li>
								<span class="date-of-last"><span class="fa fa-clock-o"></span><?= $topic['last_comment_date']?></span>
								<span class="user-of-last"><span class="fa fa-user"></span>
									<a href="\index\userProfile\<?= $topic['user_id'] ?>"><?= $topic['user'] ?></a></span>
							</li>
						</ul>
					</li>
				<?php } ?>
				<li class="group-foot"></li>
			</ul>
		<?php endforeach ?>

	</div>
</main>