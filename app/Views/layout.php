<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <title><?= esc($title) ?></title>
        
        <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css">
        <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
        
        <link rel="icon" href="<?=base_url()?>/favicon.ico">
        
        <script src="<?=base_url()?>/assets/js/common.js"></script>

    </head>
<body class="bd<?php if (get_cookie('color') == 1) { ?> black<?php } ?>">

<header> 
	<div class="wrap">
		<div class="title">
            <a title="На главную" class="logo" href="/">My</a> 
            <?php if ($uri != '') { ?>
                <div class="menu-left">
                    <ul> 
                        <li class="nav">
                            <a title="На главную" class="home" href="/">Главная</a>
                        </li>
                    </ul>    
                </div>
            <?php }?>
            
		</div>
		<div class="menu">
			<ul>  
                <li class="nav">
                    <?php if (get_cookie('color') == 0) { ?>
                        <a class="my-color" data-csrf_name="<?= csrf_token() ?>" data-csrf="<?= csrf_hash() ?>" data-color="1"> 
                            <span class="my-color-m">
                                <svg class="md-icon moon">
                                    <use xlink:href="/assets/icons/icons.svg#moon"></use>
                                </svg>  
                            </span>
                        </a>
                    <?php } else { ?>
                        <a class="my-color" data-csrf_name="<?= csrf_token() ?>" data-csrf="<?= csrf_hash() ?>" data-color="0">
                        <span class="my-color-m">
                            <svg class="md-icon moon">
                                <use xlink:href="/assets/icons/icons.svg#sun"></use>
                            </svg>   
                        </span>
                        </a>
                    <?php } ?>
                </li>
                
                <?php if ($auth) : ?>
                    <li class="nav<?= ($uri == 'setting' ? ' active' : null) ?>">
                        <a href="/setting">Настройка</a>
                    </li>
                    <li class="nav<?= ($uri == 'profile' ? ' active' : null) ?>">
                       <a class="avatar" href="/users/<?= $usr_nickname ?>">
                            <span><?php echo $usr_nickname ?></span>
                            <div class="ava"><img src="/upload/users/small/<?php echo $usr_avatar ?>"></div>
                       </a>
                    </li>
                    <li class="nav">
                        <a class="mlogout" href="/logout">Выйти</a>
                    </li>
                <?php else : ?>
                    <li class="nav<?= ($uri == 'login' ? ' active' : null) ?>">
                        <a class="logout" href="/login">Войти</a>
                    </li>
                    <li class="nav<?= ($uri == 'register' ? ' active' : null) ?>">
                        <a class="register" href="/register">Регистрация</a>
                    </li>
                <?php endif; ?>
			</ul>
		</div>
	</div>
</header> 

<section>
	<div class="wrap">
         <?= $content ?>
   </div>
<section>

<footer>
    <div class="wrap">
        <div class="menu-footer right">
            <a href="/info">Помощь</a>
            <a href="/info/privacy">Конфиденциальность</a> 
            <a href="/info/about">О нас</a>
        </div>
        <div class="info">
            &copy; <?= date('Y') ?> AreaDev ({elapsed_time} сек.)
        </div>
    </div>
</footer>

</body>
</html>