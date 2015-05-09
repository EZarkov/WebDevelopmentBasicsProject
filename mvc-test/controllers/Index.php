<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:04
 */

namespace Controllers;


use Models\Storage_Posts;
use Models\Storage_Users;
use MVC\Common;

class Index extends DefaultController {


	public function main() {


//		$val = new \MVC\Validation();
//
//		$val->setRule('url', 'http://gong.bg/')->setRule('minLength', 'http://gong.bg/', 5);
//		var_dump($val->validate());

		var_dump($_SESSION);
		$view = $this->view;
		$categories = Storage_Posts::getAllCategories();
		$topics = Storage_Posts::getAllTopicsWithDetails();
		$data = array();
		foreach ($categories as $category) {

			foreach ($topics as &$topic) {
				if ($category['id'] == $topic['category_id']) {
					$category['topics'][] = $topic;
				}
			}
			$data[] = $category;

		}

		unset ($categories);
		$view->title = 'Dev Forum';
		$view->data = $data;
		$view->appendToLayout('body', 'home');
		$view->display('layouts/default');

	}

	public function showTopic() {
		$get = $this->input->getGet();
		$topicId = Common::normalize($get[0], 'int|xss');
		$topicTitle = Common::normalize($get[1], 'string|xss');


		$topic = Storage_Posts::getTopicById($topicId);

		$postQuestions = Storage_Posts::getPostByTopicIdAndType($topicId, DefaultController::POST_TYPE_QUESTION);
		$postAnswers = Storage_Posts::getPostByTopicIdAndType($topicId, DefaultController::POST_TYPE_ANSWER);
		//var_dump($postAnswers);
		$topic['post_count'] = Storage_Posts::getTopicPostCount($topicId);

		foreach ($postQuestions as &$question) {
			foreach ($postAnswers as $answer) {
				if ($question['id'] == $answer['post_id']) {
					$question['answers'][] = $answer;
				}
			}
		}

		usort($postQuestions, function ($a, $b) {
			return $a['answers'][0]['created'] - $b['answers'][0]['created'];
		});

		$topic['posts'] = $postQuestions;

		$view = $this->view;
		$view->title = 'Dev Forum ' . $topicTitle;
		$view->data = $topic;
		$view->appendToLayout('body', 'show_topics');
		$view->display('layouts/default');
	}

	public function login() {

		$userId = Storage_Users::loginUser('test', '1234');
		var_dump($userId);
		if ($userId) {
			$_SESSION['user_id'] = (int)$userId;

		} else {

		}
		var_dump($_SESSION);
		header('Location: http://dev-forum.com');

	}
}