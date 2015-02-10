<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="keywords" />
    <meta name="description" content="{page_description}" />

    <title>{page_title} &bull; Evaluation System</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo asset_url() . 'bootstrap/dist/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url() . 'custom-styles.css'; ?>">
    <?php if (isset($styles)): foreach ($styles as $style_name): ?>
    <link rel="stylesheet" href="<?php echo asset_url() . $style_name . '.css'; ?>">
    <?php endforeach; endif; ?>
    <script src="<?php echo asset_url() . 'jquery/dist/jquery.min.js' ?>"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php if(!isset($hide_menu)): ?>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Evaluation System</a>
            </div> <!-- /.navbar-header -->
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($menu)) echo $menu; ?>
                </ul>
            </div> <!-- /#navbar -->
        </div> <!-- /.container -->
    </nav>
    <?php endif; ?>

    <!-- Main -->
    <div class="container">
