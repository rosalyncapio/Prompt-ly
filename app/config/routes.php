<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/


defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$router->get('/', 'Home::index');

// Auth routes
$router->get('login', 'Auth::gologin');
$router->post('login', 'Auth::login');
$router->get('register', 'Auth::goregister');
$router->post('register', 'Auth::register');
$router->get('logout', 'Auth::logout');
$router->get('auth/verify_email/{verification_code}', 'Auth::verify_email');
$router->post('auth/verify_email/{verification_code}', 'Auth::login');

// Admin routes
$router->get('admin/dashboard', 'Admin::dashboard');
$router->get('admin/prompts', 'Admin::prompts');
$router->get('admin/users', 'Admin::users');
$router->get('admin/entries', 'Admin::entries');
$router->get('admin/votes', 'Admin::votes');

// Prompts routes
$router->get('prompts', 'Prompts::index');
$router->match('prompts/create', 'Prompts::create', ['GET', 'POST']);
$router->match('prompts/edit/{id}', 'Prompts::edit', ['GET', 'POST']);
$router->get('prompts/delete/{id}', 'Prompts::delete');

// Users routes
$router->get('users', 'Users::index');
$router->get('users/delete/{id}', 'Users::delete');

// Entries routes
$router->get('entries', 'Entries::index');
$router->get('entries/delete/{id}', 'Entries::delete');

// Votes routes
$router->get('votes', 'Votes::index');
$router->match('votes/create', 'Votes::create', ['GET', 'POST']);
$router->match('votes/edit/{id}', 'Votes::edit', ['GET', 'POST']);
$router->get('votes/delete/{id}', 'Votes::delete');

$router->get('users/userpage', 'Users::userpage');
