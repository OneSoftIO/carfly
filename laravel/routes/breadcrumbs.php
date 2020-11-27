<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Pradinis', route('main.page'));
});

// Home > About
Breadcrumbs::register('contact', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Kontaktai', route('contact.page'));
});

// Home > Blog
Breadcrumbs::register('blog', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Straipsniai', route('blog.page'));
});
// Home > Cars
Breadcrumbs::register('cars', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Automobiliai', route('cars.page'));
});
//Home > Cars > [Car]
Breadcrumbs::register('car', function($breadcrumbs, $post)
{
    $breadcrumbs->parent('cars');
    $breadcrumbs->push($post->name, route('car.page', $post->slug));
});

Breadcrumbs::register('other', function($breadcrumbs, $post)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($post->post_title, route('car.page', $post->slug));
});