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
