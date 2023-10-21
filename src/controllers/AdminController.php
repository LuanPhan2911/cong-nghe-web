<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Story;
use App\Models\User;

class AdminController
{
    public function index()
    {

        $breadcrumb = [
            [
                "url" => "/admin",
                "name" => "Home"
            ]
        ];


        $storyModel = new Story();
        $userModel = new User();

        $commentModel = new Comment();

        [
            'data' => $stories,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page,
        ] = $storyModel->paginate(limit: 10, withDeletedAt: true);

        $prev = $page - 1;
        $next = $page + 1;



        $total_view_count = $storyModel->totalViewCount();

        $total_user = $userModel->countAll();

        $total_comment = $commentModel->countAll();
        return view("admin.index", [
            'breadcrumb' => $breadcrumb,
            'stories' => $stories,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'page' => $page,
            'prev' => $prev,
            'next' => $next,
            'total_view_count' => $total_view_count,
            'total_user' => $total_user,
            'total_comment' => $total_comment


        ]);
    }
}
