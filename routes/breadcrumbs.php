<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', '/');
});
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Home', '/');
});

Breadcrumbs::for('master-data', function (BreadcrumbTrail $trail) {
    $trail->push('Master Data', '/');
});
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('master-data');
    $trail->push('User', '/user');
});

Breadcrumbs::for('data-user', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('List', '/');
});

Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('master-data');
    $trail->push('Roles', '/roles');
});
Breadcrumbs::for('data-roles', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('List', '/roles');
});
Breadcrumbs::for('role-management', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Management Role', '/roles');
});

Breadcrumbs::for('area', function (BreadcrumbTrail $trail) {
    $trail->parent('master-data');
    $trail->push('Area', '/area');
});
Breadcrumbs::for('data-area', function (BreadcrumbTrail $trail) {
    $trail->parent('area');
    $trail->push('List', '/roles');
});

Breadcrumbs::for('qna', function (BreadcrumbTrail $trail) {
    $trail->parent('master-data');
    $trail->push('Question & Answer', '/qna');
});
Breadcrumbs::for('question', function (BreadcrumbTrail $trail) {
    $trail->parent('qna');
    $trail->push('Question', '/qna');
});
Breadcrumbs::for('answer', function (BreadcrumbTrail $trail) {
    $trail->parent('question');
    $trail->push('Answer', '/qna');
});

Breadcrumbs::for('transaction', function (BreadcrumbTrail $trail) {
    $trail->push('Transaction', '/');
});

Breadcrumbs::for('daily_inspection', function (BreadcrumbTrail $trail) {
    $trail->parent('transaction');
    $trail->push('Daily Inspection', '/daily-inspection');
});
Breadcrumbs::for('daily_inspection_perarea', function (BreadcrumbTrail $trail) {
    $trail->parent('daily_inspection');
    $trail->push('Daily Inspection In Area', '/daily-inspection');
});
Breadcrumbs::for('detail_daily_inspection', function (BreadcrumbTrail $trail) {
    $trail->parent('daily_inspection_perarea');
    $trail->push('Detail Daily Inspection', '/daily-inspection');
});

Breadcrumbs::for('issue', function (BreadcrumbTrail $trail) {
    $trail->parent('transaction');
    $trail->push('Issue', '/issue');
});
Breadcrumbs::for('detail_issue', function (BreadcrumbTrail $trail) {
    $trail->parent('issue');
    $trail->push('Detail Issue', '/issue');
});
