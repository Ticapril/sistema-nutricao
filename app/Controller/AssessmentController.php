<?php

namespace App\Controller;

use \App\Model\Assessment;

// O que essa classe faz?
class AssessmentController extends Page
{
    public static function getDataForm($postVars = [])
    {
        $student = StudentController::getStudent($postVars);
        if (!empty($student)) {
            return $student[0];
        }
    }
    public static function createAssesment($postVars = []): void
    {
        $assesment = new Assessment($postVars);
        $assesment->create($assesment);
    }
}
