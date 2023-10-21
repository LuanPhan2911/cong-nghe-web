<?php

namespace App\Controllers;

use App\Models\Report;

class ReportController
{
    public function index($reported_type)
    {
        $breadcrumb = [
            [
                "url" => "/admin",
                "name" => "Home"
            ],
            [
                "url" => NULL,
                "name" => "Reports"
            ],
        ];

        $reported_type = htmlspecialchars($reported_type);

        if (!in_array($reported_type, ['stories', 'comments'])) {
            redirect("/404");
            exit;
        }

        $comments = [];
        $stories = [];

        $reportModel = new Report();

        if ($reported_type == 'comments') {
            $comments = $reportModel->getReport('comments');
        } else {
            $stories = $reportModel->getReport('stories');
        }

        return view("admin.reports", [
            'breadcrumb' => $breadcrumb,
            'comments' => $comments,
            'stories' => $stories,
            'reported_type' => $reported_type
        ]);
    }
    public function store()
    {
        header('Content-Type: application/json; charset=utf-8');
        $redirect_back = $_SERVER['HTTP_REFERER'];

        $reported_type = htmlspecialchars($_POST['reported_type']) ?? NULL;
        $reported_id = htmlspecialchars($_POST['reported_id']) ?? NULL;
        $report_content = htmlspecialchars($_POST['content']) ?? NULL;



        if (empty($reported_id) || empty($reported_type) || empty($report_content)) {
            echo json_encode([
                'message' => "Một vài trường dữ liệu bỏ bỏ trống!",
                'success' => false
            ]);
            return;
        }

        if (!in_array($reported_type, ['stories', 'comments'])) {
            echo json_encode([
                'message' => "Bạn chỉ có thể báo cáo reviews hoặc comments",
                'success' => false
            ]);
            return;
        }

        $reportModel = new Report();

        $validReport = $reportModel->valid($reported_type, $reported_id);

        if (empty($validReport)) {
            echo json_encode([
                'message' => "Nội dung báo cáo không hợp lệ!",
                'success' => false
            ]);
            return;
        }


        $result = $reportModel->insert(compact(['reported_id', 'reported_type', 'report_content']));

        if (empty($result)) {
            echo json_encode([
                'message' => "=Có lỗi xảy ra!",
                'success' => false
            ]);
            return;
        }


        echo json_encode([
            'message' => "Báo cáo thành công!",
            'success' => true
        ]);
    }

    public function updateState($report_id, $action)
    {

        $redirect_back =  $_SERVER['HTTP_REFERER'];


        $id = htmlspecialchars($report_id);
        $action = htmlspecialchars($action);
        $reportModel = new Report();

        if ($action == 'finish') {
            $reportModel->finish($id);
        } else {
            $reportModel->unFinish($id);
        }

        $action = ucfirst($action);
        $_SESSION["msg"] = "$action reports success!";

        redirect($redirect_back);
        exit;
    }

    public function deleteFinish($reported_type)
    {
        $type = htmlspecialchars($reported_type);
        $redirect_back = $_SERVER['HTTP_REFERER'];

        if (!in_array($type, ['comments', 'stories'])) {
            redirect($redirect_back);
            exit;
        }


        $reportModel = new Report();

        $reportModel->deleteFinish($type);

        $_SESSION["msg"] = "Delete finish reports success!";

        redirect($redirect_back);
        exit;
    }
}
