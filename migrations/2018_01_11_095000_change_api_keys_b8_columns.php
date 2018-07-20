<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('api_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('allowed_ips')->nullable();
            $table->string('scopes')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->dateTime('created_at');
            $table->dateTime('last_activity_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('api_keys', function (Blueprint $table) {
            $table->dropForeign('api_keys_user_id_foreign');
            $table->dropColumn('id', 'allowed_ips', 'user_id', 'scopes', 'created_at');
        });
    }
];
