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
        if (!empty($request['first_name']) && !empty($request['last_name']) && !empty($request['student_id']) && !empty($request['class']) && !empty($request['day']) && !empty($request['time']) && !empty($request['platform'])) {
            $group_member = $this->generateGroupMemberService->logic(
                $request['student_id'],
                $request['class'],
                $request['friend'],
                $request['platform'],
                $request['day'],
            );
            if ($group_member == 400) {
                $_SESSION['notification'] = 'Student Id Already Used, Please Check Your Input';
                return header("Location: member.php");
            } else if ($group_member == 401) {
                $_SESSION['notification'] = 'Friend Not Found, Choose Other';
                return header("Location: member.php");
            } else if ($group_member == 402) {
                $_SESSION['notification'] = 'All Group In This Workspace Is Full';
                return header("Location: member.php");
            }
            // store data here, we get group member
            var_dump($group_member, $request);
            die;
        } else {
            $_SESSION['notification'] = 'Please fill in the required data';
            return header("Location: member.php");
        }
    }
}
