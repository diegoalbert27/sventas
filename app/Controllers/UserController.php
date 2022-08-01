<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserController class
 */
class UserController
{

    /**
     * This method load the 'employees' route. <br/>
     * <b>post: </b>access to GET method.
     */
    public function getIndex()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        return new Response(require '../app/Views/employee.php', 200);
    }

    public function get()
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $user_model = new UserModel();
        $users = $user_model->findAll();
        $employees = [];

        foreach ($users as $user) {
            $role_id = (int)$user->role_id;
            if ($role_id === 2) {
                $employees[] = $user;
            }
        }

        $body_response = json_encode($employees);

        return new Response(
            $body_response,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    public function postUser(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        $password_hash = password_hash($request->request->get('password'), PASSWORD_BCRYPT);

        $new_user = [
            'username'      => $request->request->get('username'),
            'email'         => $request->request->get('email'),
            'password'      => $password_hash,
            'first_name'    => $request->request->get('first_name'),
            'last_name'     => $request->request->get('last_name'),
            'status'        => 1,
            'created_at'    => date('Y-m-d'),
            'role_id'       => $request->request->get('role_id'),
        ];

        $User = new User($new_user);
        $user_model = new UserModel();
        $is_registered = $user_model->save($User);

        $result = null;

        if ($is_registered) {
            $result = [
                'message' => 'success'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_CREATED,
                ['content-type' => 'application/json']
            );
        } else {
            $result = [
                'message' => 'error'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }
    }

    public function editUser(Request $request)
    {
        if (!$_SESSION['login']) {
            return new RedirectResponse('/', 302);
        }

        if (empty($request->request->get('id'))) {
            $result = [
                'message' => 'id is missed'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }


        $request_user = [
            'username'      => $request->request->get('username'),
            'email'         => $request->request->get('email'),
            'password'      => null,
            'first_name'    => $request->request->get('first_name'),
            'last_name'     => $request->request->get('last_name'),
            'status'        => $request->request->get('status'),
            'created_at'    => null,
            'role_id'       => $request->request->get('role_id'),
            'id'            => $request->request->get('id')
        ];

        $user_model = new UserModel();
        $user = $user_model->findById($request_user['id']);

        if (!$user) {
            $result = [
                'message' => 'User not found'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        $edit_user = [];

        foreach ($request_user as $key => $value) {
            if (is_null($value)) {
                $edit_user[$key] = $user->$key;
            } else {
                $edit_user[$key] = $value;
            }
        }

        $is_edited = $user_model->update(new User($edit_user));

        $result = null;

        if ($is_edited) {
            $result = [
                'message' => 'success'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );
        } else {
            $result = [
                'message' => 'error'
            ];

            $body_response = json_encode($result);

            return new Response(
                $body_response,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }

        return new Response(
            json_encode($edit_user),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
