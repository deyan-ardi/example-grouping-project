<?php

namespace app\Services;

class generateGroupMemberService
{
    public function logic(string $studentID, string $class, string $friend, string $platform)
    {
        $class_file = null;
        $file_to_read = fopen("../database/General/all_class.csv", "r");
        if ($file_to_read !== FALSE) {
            while (($data = fgetcsv($file_to_read)) !== FALSE) {
                foreach ($data as $i) {
                    if ($data[0] == $class) {
                        $class_file = $data[2];
                    }
                    break;
                }
            }
            fclose($file_to_read);
        }
        $filename = "../database/Uploaded/" . $class_file . "";
        $student = $this->getStudentData($filename, $studentID);
        if (!$student) {
            return 25 % 5;
            // return false;
        }
    }

    public function getStudentData(string $filename, string $studentID)
    {
        if (!file_exists($filename)) {
            fopen($filename, "w");
        }

        $student_to_read = fopen($filename, "r");
        if ($student_to_read !== FALSE) {
            while (($student = fgetcsv($student_to_read)) !== FALSE) {
                foreach ($student as $i) {
                    if (strtolower($student[1]) == strtolower($studentID)) {
                        return false;
                        break;
                    } else {
                    }
                }
            }
            fclose($student_to_read);
        }
    }
}
