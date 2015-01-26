<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?php echo "$siteName $specialChar $pageTitle";?></title>
    <meta name="author" content="<?php echo $pageAuthor; ?>" />
    <meta name="description" content="<?php echo $pageDescriptions ?>" />
    <meta name="keywords" content="<?php echo $pageKeywords ?>" />
    <link href="Themes/Default/css/main.css" rel="stylesheet">
</head>
<body>
<div id="main">
    <div id="navigator">
        <div class="left-nav-bar">
            <div id="logo"><a href="/" class="go-home" title="HotBrain"></a></div>
            <div class="first-menu-item">
                <div id="site-menu"><a href="#" class="menu" title="Меню"></a></div>
            </div>
            <div class="second-menu-item">
                <div id="php-5"><a href="#" class="php" title="PHP"></a></div>
            </div>
            <div class="second-menu-item">
                <div id="html-5"><a href="#" class="html5" title="HTML5"></a></div>
            </div>
            <div class="second-menu-item">
                <div id="css-3"><a href="#" class="css3" title="CSS3"></a></div>
            </div>
            <div class="second-menu-item">
                <div id="java-script"><a href="#" class="js" title="JavaScript"></a></div>
            </div>
            <a href="#" class="menu-separator guest-separator"></a>
            <div class="last-menu-item"><a href="#" class="admin-login" title="Войти"></a></div>
        </div>
    </div>
    <div class="right-block">
        <main class="page-content">
            <div class="wnd_title">
            </div>
            <div class="wnd_line"></div>

            <div id="wnd_menu_v2">
            </div>
            <div class= "gallery-content">
                <div class="gallery-wrapper">
                    <?php include 'Themes/Default/views/' . $content_view; ?>
                    <div id="cb" style="padding-top: 22px;"></div>
                </div>

        </main><!-- .content -->
    </div><!-- right-block -->
</div>
</body>
</html>