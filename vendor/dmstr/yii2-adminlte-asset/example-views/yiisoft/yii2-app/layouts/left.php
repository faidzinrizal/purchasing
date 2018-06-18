<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
 -->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Logistik',
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Buat Permintaan', 
                                'icon' => 'edit',
                                'url' => ['/permintaan/create']
                            ],
                        ],
                    ],
                    [
                        'label' => 'Keuangan',
                        'icon' => 'money',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'List Permintaan', 
                                'icon' => 'list',
                                'url' => ['/permintaan/index']
                            ],
                            [
                                'label' => 'List Penawaran', 
                                'icon' => 'list',
                                'url' => ['/penawaran/index']
                            ],
                        ],
                    ],
                    [
                        'label' => 'Direktur',
                        'icon' => 'industry',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'List Penawaran', 
                                'icon' => 'list',
                                'url' => ['/penawaran/index']
                            ],
                        ],
                    ],
                    [
                        'label' => 'Master',
                        'icon' => 'database',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Supplier', 
                                'icon' => 'credit-card',
                                'url' => ['/supplier/index']
                            ],
                            [
                                'label' => 'Barang',
                                'icon' => 'dropbox',
                                'url' => ['/barang/index']
                            ],
                        ],
                    ],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Same tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>

    </section>

</aside>
