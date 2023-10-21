<?php

namespace App\Controllers;

use App\Models\Story;

class StoryController
{
    public function countReview()
    {
        header('Content-Type: application/json; charset=utf-8');

        $storyModel = new Story();

        $result = $storyModel->getReviewChart();




        if (isset($result)) {
            $data = [];
            foreach ($result as $each) {
                $data[] = $each;
            }
            echo json_encode([
                "data" => $data,
                "success" => true
            ]);
            return;
        }
        echo json_encode([
            "data" => [],
            "success" => false
        ]);
    }
    public function create()
    {
        $breadcrumb = [
            [
                "url" => "/admin",
                "name" => "Home"
            ],
            [
                "url" => NULL,
                "name" => "Create Review"
            ],
        ];
        return view('admin.create_review', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function store()
    {
        $name = htmlspecialchars($_POST['name']) ?? NULL;
        $author_name = htmlspecialchars($_POST['author_name']) ?? NULL;
        $description = htmlspecialchars($_POST['description']) ?? NULL;
        $review_content = htmlspecialchars($_POST['review_content']) ?? NULL;
        $genres = htmlspecialchars($_POST['genres']) ?? NULL;

        $avatar = $_FILES['avatar'];


        if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres)) {
            $_SESSION['err'] = "Missing some field data!";
            $_SESSION['story_name'] = $name;
            $_SESSION['author_name'] = $author_name;
            $_SESSION['genres'] = $genres;
            $_SESSION['description'] = $description;
            $_SESSION['review_content'] = $review_content;
            redirect("/admin/stories/create");
            exit;
        }
        if (!is_uploaded_file($avatar['tmp_name'])) {
            $_SESSION['err'] = "Missing avatar!";
            $_SESSION['story_name'] = $name;
            $_SESSION['author_name'] = $author_name;
            $_SESSION['genres'] = $genres;
            $_SESSION['description'] = $description;
            $_SESSION['review_content'] = $review_content;
            redirect("/admin/stories/create");
            exit;
        }

        $path_avatar = upload_file($avatar, "reviews/");




        $storyModel = new Story();

        $storyModel->insert([
            'name' => $name,
            'author_name' => $author_name,
            'description' => $description,
            'review_content' => $review_content,
            'genres' => $genres,
            'path_avatar' => $path_avatar
        ]);
        $_SESSION['msg'] = "Create Review Success!";
        redirect("/admin");
        exit;
    }

    public function edit($story_id)
    {
        $_SESSION['redirect_back'] = $_SERVER['HTTP_REFERER'];
        $breadcrumb = [
            [
                "url" => "/admin",
                "name" => "Home"
            ],
            [
                "url" => NULL,
                "name" => "Update Review"
            ],
        ];
        if (empty($story_id) || !is_numeric($story_id)) {
            $_SESSION['err'] = "Mising Story Id to edit Review!";
            redirect("/admin/index.php");
            exit;
        }
        $id = htmlspecialchars($story_id);
        $storyModel = new Story();

        $story = $storyModel->findOne($id, withDeletedAt: true);
        if (empty($story)) {
            $_SESSION['err'] = "Story Not Found to edit!";
            redirect("/admin/index.php");
            exit;
        }
        return view("admin.edit_review", [
            'breadcrumb' => $breadcrumb,
            'story' => $story
        ]);
    }

    public function update()
    {
        $id = htmlspecialchars($_POST['id']) ?? NULL;
        $name = htmlspecialchars($_POST['name']) ?? NULL;
        $author_name = htmlspecialchars($_POST['author_name']) ?? NULL;
        $description = htmlspecialchars($_POST['description']) ?? NULL;
        $review_content = htmlspecialchars($_POST['review_content']) ?? NULL;
        $genres = htmlspecialchars($_POST['genres']) ?? NULL;

        $avatar = $_FILES['avatar'];

        $_SESSION['story_name'] = $name;
        $_SESSION['author_name'] = $author_name;
        $_SESSION['genres'] = $genres;
        if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres) || empty($id)) {
            $_SESSION['err'] = "Missing some field data!";

            redirect("/admin/stories/edit/$id");
            exit;
        }

        $storyModel = new Story();

        $old_avatar = $storyModel->getAvatar($id);
        $path_avatar = $old_avatar;
        if (is_uploaded_file($avatar['tmp_name'])) {
            remove_file($old_avatar);
            $path_avatar = upload_file($avatar, "reviews/");
        }





        $storyModel->update(compact([
            'name', 'author_name',
            'description', 'review_content',
            'genres', 'path_avatar', 'id'
        ]));




        $_SESSION['msg'] = "Update Review Success!";

        $redirect_back = flash('redirect_back');
        redirect($redirect_back);
        exit;
    }

    public function updateState($story_id, $action)
    {
        $id = htmlspecialchars($story_id);
        if (empty($id) || !is_numeric($id)) {
            redirect("/admin");
            exit;
        }
        $storyModel = new Story();
        switch ($action) {
            case 'pin':
                $storyModel->pinned($id);
                break;
            case 'unpin':
                $storyModel->unPinned($id);
                break;
            case 'show':
                $storyModel->show($id);
                break;
            case 'hide':
                $storyModel->hide($id);
                break;
            default:
                break;
        }
        $action = ucfirst($action);
        $_SESSION["msg"] = "$action review success!";



        redirect("/admin");
        exit;
    }
    public function destroy($story_id)
    {
        $id = htmlspecialchars($story_id);
        if (empty($id) || !is_numeric($id)) {
            redirect("/admin");
            exit;
        }
        $storyModel = new Story();
        $avatar = $storyModel->getAvatar($id);
        if (!empty($avatar)) {
            remove_file($avatar);
        }
        $result = $storyModel->delete($id);
        if (isset($result)) {
            $_SESSION["msg"] = "Delete review success!";
        }

        redirect("/admin");
        exit;
    }
}
