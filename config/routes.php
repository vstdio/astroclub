<?php
    function getRoutes()
    {
        return array(
            "~^$~"                                      => "home/index/1",
            "~^pages/([1-9][0-9]*)$~"                   => "home/index/$1",
            "~^articles$~"                              => "home/index",
            "~^about$~"                                 => "home/about",
            "~^contacts$~"                              => "home/contact",
            "~^search\\?query=(.*)$~"                   => "home/search",
            "~^404$~"                                   => "home/nfound",

            "~^user/register$~"                         => "user/register",
            "~^user/login$~"                            => "user/login",
            "~^user/logout$~"                           => "user/logout",
            "~^user/([1-9][0-9]*)$~"                    => "user/view/$1",

            "~^cabinet$~"                               => "cabinet/index",
            "~^cabinet/edit$~"                          => "cabinet/edit",
            "~^articles/add$~"                          => "cabinet/add",

            "~^articles/([0-9]+)$~"                     => "article/view/$1",
            "~^categories/([0-9]+)$~"                   => "article/category/$1/1",
            "~^categories/([0-9]+)/pages/([0-9]+)$~"    => "article/category/$1/$2",
        );
    }
