<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" 
    i ntegrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=East+Sea+Dokdo|Libre+Baskerville" rel="stylesheet">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="header-inner">

        </div>
        <?php wp_nav_menu(array(
            'theme_location' => 'header-nav',
            'container' => 'nav',
            'container_class' => 'header-nav',
            'container_id' => 'header-nav',
            'fallback_cb' => ''
        )); ?>
    </header>