<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 09.05.15
 * Time: 13:37
 */

namespace Models;


class Storage_Posts  extends Storage_Abstract{

	public static function getAllCategories(){

		$categories = self::$db ->prepare('SELECT * FROM `categories`', array())->execute()->fetchAllAssoc();

		return $categories;
	}

	public static function getAllTopics(){
		$topics = self::$db ->prepare('SELECT * FROM `topics`', array())->execute()->fetchAllAssoc();

		return $topics;
	}
	public static function getTopicsByCategoryId($id){

		$topics = self::$db ->prepare('SELECT * FROM `topics` WHERE `category_id` = ?', array($id))->execute()->fetchAllAssoc();

		return $topics;
	}
	public static function getAllTopicsWithDetails(){
		$topics = self::$db ->prepare('SELECT
										u.`id` AS user_id,
										u.`user`,
										p.`created` AS last_comment_date,
										count(p.`id`) AS count,
										t.`category_id`,
										t.`id`,
										t.`title`,
										t.`description`
									FROM
										(
											SELECT
												*
											FROM
												`posts`
											ORDER BY
												`created` DESC
										) p
									JOIN `topics` t ON t.`id` = p.`topic_id`
									JOIN `users` u ON u.id = p.`user_id`
									GROUP BY
										t.`id`', array())->execute()->fetchAllAssoc();

		return $topics;
	}

	public static function getTopicById($id){

		$topic = self::$db ->prepare('SELECT * FROM `topics` WHERE `id` = ?', array($id))->execute()->fetchRowAssoc();

		return $topic;
}

	public static function getPostByTopicIdAndType($id, $type){


		$posts = self::$db ->prepare('SELECT
										p.`id`,
										p.`title`,
										p.`text`,
										p.`created`,
										p.`post_id`,
										p.`user_id`,
										u.`user`
									FROM
										`posts` p
									JOIN `users` u ON p.`user_id` = u.`id`
									WHERE
										`topic_id` = ?
									AND `type` = ?
									ORDER BY
										`created` DESC', array($id, $type))->execute()->fetchAllAssoc();
		return $posts;
	}

	public static function getTopicPostCount($id){
		$count = self::$db->prepare('SELECT COUNT(`id`)as `count` FROM `posts` WHERE `topic_id` = ?', array($id))->execute()->fetchRowAssoc();
		return $count['count'];
	}
}