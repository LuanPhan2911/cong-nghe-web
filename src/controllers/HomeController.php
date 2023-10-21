<?php

namespace App\Controllers;

use App\Models\Story;

class HomeController
{

    public function index()
    {
        $storyModel = new Story();

        $feature_review = $storyModel->getFeatureReview();

        [
            'data' => $reviews,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page,
        ] = $storyModel->paginate();

        $prev = $page - 1;
        $next = $page + 1;

        $newest_review = $storyModel->getNewReview();

        return view("index", [
            'feature_review' => $feature_review,
            'reviews' => $reviews,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'page' => $page,
            'prev' => $prev,
            'next' => $next,
            'newest_review' => $newest_review


        ]);
    }
    public function show($story_id)
    {
        if (empty($story_id) || !is_numeric($story_id)) {
            redirect("/404");
            exit;
        }

        $id = htmlspecialchars($story_id);


        $storyModel = new Story();

        $story = $storyModel->findOne($id);

        if (empty($story)) {
            redirect("/404");
            exit;
        }
        if (isset($_SESSION['view_count_delay'])) {
            $time_delay = $_SESSION['view_count_delay'];
            if (time() - $time_delay >= 0) {
                $storyModel->updateViewCount($id);
                unset($_SESSION['view_count_delay']);
            }
        } else {
            $_SESSION['view_count_delay'] = time() + 60;
            $storyModel->updateViewCount($id);
        }

        $newest_review = $storyModel->getNewReview();
        return view("review", [
            'story' => $story,
            'newest_review' => $newest_review
        ]);
    }

    public function search()
    {
        $q = htmlspecialchars($_GET['q']) ?? NULL;
        $redirect_back =  $_SERVER['HTTP_REFERER'];
        if (empty($q)) {
            redirect($redirect_back);
            exit;
        }
        $storyModel = new Story();

        $reviews = $storyModel->findAll($q);
        $newest_review = $storyModel->getNewReview();
        return view("search", [
            'q' => $q,
            'reviews' => $reviews,
            'newest_review' => $newest_review
        ]);
    }
    public function page404()
    {
        return view('404');
    }
}
