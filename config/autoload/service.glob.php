<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.08.16
 * Time: 13:07
 */
return [
    'dataStore' => [
        'old_analit_views' => [
            'class' => 'App\DataStore\Cashable\CashableStore\DbGetAll',
            'tableName' => 'analit_views',
            'dbAdapter' => 'db_old'
        ],
        'new_analit_views' => [
            'class' => 'zaboy\res\DataStore\DbTable',
            'tableName' => 'views',
            'dbAdapter' => 'db_new'
        ],
        'update_analit_views' => [
            'class' => 'App\DataStore\Cashable\CashableStore\CashableStore',
            'getAll' => 'old_analit_views',
            'cashStore' => 'new_analit_views',
            'limit' => '50000',
        ],


        'old_analit_sold' => [
            'class' => 'App\DataStore\Cashable\CashableStore\DbGetAll',
            'tableName' => 'analit_sold',
            'dbAdapter' => 'db_old'
        ],
        'new_analit_sold' => [
            'class' => 'zaboy\res\DataStore\DbTable',
            'tableName' => 'sold',
            'dbAdapter' => 'db_new'
        ],
        'update_analit_sold' => [
            'class' => 'App\DataStore\Cashable\CashableStore\CashableStore',
            'getAll' => 'old_analit_sold',
            'cashStore' => 'new_analit_sold',
            'limit' => '5000',
        ],


        'old_analit_publish' => [
            'class' => 'App\DataStore\Cashable\CashableStore\DbGetAll',
            'tableName' => 'analit_publish',
            'dbAdapter' => 'db_old'
        ],
        'new_analit_publish' => [
            'class' => 'zaboy\res\DataStore\DbTable',
            'tableName' => 'publish',
            'dbAdapter' => 'db_new'
        ],
        'update_analit_publish' => [
            'class' => 'App\DataStore\Cashable\CashableStore\CashableStore',
            'getAll' => 'old_analit_publish',
            'cashStore' => 'new_analit_publish',
            'limit' => '50000',
        ],


        'App\DataStore\Cashable\CashableStore\AnalitProductsByBrandCategoryUnionGetAll' => [
            'dbAdapter' => 'db_old',
            'class' => 'App\DataStore\Cashable\CashableStore\AnalitProductsByBrandCategoryUnionGetAll'

        ],
        'new_analit_products_by_brand_category' => [
            'class' => 'App\DataStore\Cashable\CashableStore\DbGetAll',
            'tableName' => 'products',
            'dbAdapter' => 'db_new'
        ],
        'update_analit_products_by_brand_category' => [
            'class' => 'App\DataStore\Cashable\CashableStore\CashableStore',
            'getAll' => 'App\DataStore\Cashable\CashableStore\AnalitProductsByBrandCategoryUnionGetAll',
            'cashStore' => 'new_analit_products_by_brand_category',
            'limit' => '1',
        ],


        'App\DataStore\Cashable\CashableStore\JournalUnionDbGetAll' => [
            'dbAdapter' => 'db_old',
            'class' => 'App\DataStore\Cashable\CashableStore\JournalUnionDbGetAll'
        ],
        'new_journal_publish_exceed_the_amount_limits' => [
            'class' => 'zaboy\res\DataStore\DbTable',
            'tableName' => 'journal_publish_exceed_the_amount_limits',
            'dbAdapter' => 'db_new'
        ],
        'update_journal_publish_exceed_the_amount_limits' => [
            'class' => 'App\DataStore\Cashable\CashableStore\JournalCachebleStore',
            'getAll' => 'App\DataStore\Cashable\CashableStore\JournalUnionDbGetAll',
            'cashStore' => 'new_journal_publish_exceed_the_amount_limits',
            'limit' => '10',
            'category' => 'publish exceed the amount limits'
        ],

        'new_journal_publish_exceed_the_amount' => [
            'class' => 'zaboy\res\DataStore\DbTable',
            'tableName' => 'journal_publish_exceed_the_amount',
            'dbAdapter' => 'db_new'
        ],
        'update_journal_publish_exceed_the_amount' => [
            'class' => 'App\DataStore\Cashable\CashableStore\JournalCachebleStore',
            'getAll' => 'App\DataStore\Cashable\CashableStore\JournalUnionDbGetAll',
            'cashStore' => 'new_journal_publish_exceed_the_amount',
            'limit' => '10',
            'category' => 'publish exceed the amount'
        ],
    ]
];