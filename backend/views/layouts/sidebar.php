<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SITE CORE</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->getIdentity()->email ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii']],
                    ['label' => 'Пользователи',  'icon' => 'user', 'url' => ['/user']],
                    ['label' => 'События', 'icon' => 'events', 'url' => ['/event']],
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>