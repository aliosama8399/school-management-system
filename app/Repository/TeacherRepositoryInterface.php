<?php

namespace App\Repository;
interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    // Get specialization
    public function Getspecialization();

    // Get Gender
    public function GetGender();

    // StoreTeachers
    public function StoreTeachers($request);

    // StoreTeachers
    public function editTeachers($id);

    // UpdateTeachers
    public function UpdateTeachers($request);

    // DeleteTeachers
    public function DeleteTeachers($request);
}
