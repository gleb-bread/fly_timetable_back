<?php

namespace App\Helper\User;

use App\Models\User;
use App\Models\UserAssigment;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Role;
use App\Models\RoleUserAssigment;

class ConnectUser {

    private User $_user;
    private UserAssigment $_assigment;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function connectionProject(){
        $this->createAssigment();
        $this->createRoleAssigment();
    }

    private function createAssigment(){
        $type = ProjectType::getUserType();
        $project = Project::where('project_type_id', $type->id)->first();
        $this->_assigment = UserAssigment::create(['user_id' => $this->_user->id, 'project_id' => $project->id]);
    }

    private function createRoleAssigment(){
        $role = Role::getUserRole();
        RoleUserAssigment::create(['role_id' => $role->id, 'user_assigment_id' => $this->_assigment->id]);
    }
}