<?php

namespace app\Controller;

require_once '../app/Services/generateGroupMemberService.php';

use app\Services\generateGroupMemberService;

class registerMemberController
{
    public $generateGroupMemberService;
    public function __construct()
    {
        $this->generateGroupMemberService = new generateGroupMemberService();
    }

    public function storeMember()
    {
        $request = $_REQUEST;
        if (!empty($request['first_name']) && !empty($request['last_name']) && !empty($request['student_id']) && !empty($request['class']) && !empty($request['friend']) && !empty($request['platform'])) {
            $group_member = $this->generateGroupMemberService->logic($request['student_id'], $request['class'], $request['friend'], $request['platform']);
            var_dump($group_member);
            die;
            if (!$group_member) {
                $_SESSION['notification'] = 'Student Id Already Used, Please Check Your Input';
                return header("Location: member.php");
            }
        } else {
            $_SESSION['notification'] = 'All Field Is Required, Please Input All Data';
            return header("Location: member.php");
        }
    }
}
