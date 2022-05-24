<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Post Types
	|--------------------------------------------------------------------------
	|
	| Here you may specify the post types to be registered by Poet using the
	| Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
	|
	*/

	'post' => [
		'event' => [
			'show_in_rest'  => true,
			'supports'      => ['permalink', 'title', 'editor', 'thumbnail'],
			'menu_icon'     => 'dashicons-calendar-alt',
			'menu_position' => 28,
			'rewrite'       => [
				'slug'      => 'evenement'
			],
			'labels' => [
				'singular'                 => __('Evenement', 'sage'),
				'plural'                   => __('Agenda', 'sage'),
				'add_new'                  => __('Nieuw evenement', 'sage'),
				'add_new_item'             => __('Voeg nieuw evenement toe', 'sage'),
				'edit_item'                => __('Bewerk evenement', 'sage'),
				'new_item'                 => __('Nieuw evenement', 'sage'),
				'view_item'                => __('Bekijk evenement', 'sage'),
				'view_items'               => __('Bekijk evenement', 'sage'),
				'search_items'             => __('Zoek evenementen', 'sage'),
				'not_found'                => __('Geen evenementen gevonden.', 'sage'),
				'not_found_in_trash'       => __('Geen evenementen gevonden in prullenmand', 'sage'),
				'parent_item_colon'        => __('Hoofd evenement', 'sage'),
				'all_items'                => __('Alle evenementen', 'sage'),
				'archives'                 => __('Evenement archieven', 'sage'),
				'attributes'               => __('Evenement attributen', 'sage'),
				'insert_into_item'         => __('Voeg in evenement', 'sage'),
				'uploaded_to_this_item'    => __('Geüpload naar dit evenement', 'sage'),
				'item_published'           => __('Evenement gepubliceerd.', 'sage'),
				'item_published_privately' => __('Evenement privé gepubliceerd.', 'sage'),
				'item_reverted_to_draft'   => __('Evenement teruggekeerd naar concept.', 'sage'),
				'item_scheduled'           => __('Evenement ingepland.', 'sage'),
				'item_updated'             => __('Evenement bijgewerkt.', 'sage')
			],
			'admin_cols'  => [
				'title' => [
					'title' => __('Title')
				],
				'start_date' => [
					'title'       => __('Start datum', 'sage'),
					'function'    => function() {
						global $post;
						$start_date = get_field('event_details_start_date', $post->ID);
						echo $start_date;
					},
					'default'     => 'DESC'
				],
				'end_date' => [
					'title'       => __('Eind datum', 'sage'),
					'function'    => function() {
						global $post;
						$end_date = get_field('event_details_end_date', $post->ID);
						echo $end_date;
					}
				],
				'date',
				'author'
			]
		],
		'news_item' => [
			'enter_title_here'   => __('Voer titel in', 'sage'),
			'supports'           => ['permalink', 'title', 'editor', 'thumbnail'],
			'menu_icon'          => 'dashicons-format-aside',
			'menu_position'      => 29,
			'public'             => false,
			'show_in_rest'       => true,
			'rewrite'            => [
				'slug'           => 'nieuwsbericht'
			],
			'labels' => [
				'singular'                 => __('Nieuwsbericht', 'sage'),
				'plural'                   => __('Nieuws', 'sage'),
				'add_new'                  => __('Nieuw nieuwsbericht', 'sage'),
				'add_new_item'             => __('Voeg nieuw nieuwsbericht toe', 'sage'),
				'edit_item'                => __('Bewerk nieuwsbericht', 'sage'),
				'new_item'                 => __('Nieuw nieuwsbericht', 'sage'),
				'view_item'                => __('Bekijk nieuwsbericht', 'sage'),
				'view_items'               => __('Bekijk nieuwsbericht', 'sage'),
				'search_items'             => __('Zoek nieuwsberichten', 'sage'),
				'not_found'                => __('Geen nieuwsberichten gevonden.', 'sage'),
				'not_found_in_trash'       => __('Geen nieuwsberichten gevonden in prullenmand', 'sage'),
				'parent_item_colon'        => __('Hoofd nieuwsbericht', 'sage'),
				'all_items'                => __('Alle nieuwsberichten', 'sage'),
				'archives'                 => __('Nieuws archieven', 'sage'),
				'attributes'               => __('Nieuwsbericht attributen', 'sage'),
				'insert_into_item'         => __('Voeg in nieuwsbericht', 'sage'),
				'uploaded_to_this_item'    => __('Geüpload naar dit nieuwsbericht', 'sage'),
				'item_published'           => __('Nieuwsbericht gepubliceerd.', 'sage'),
				'item_published_privately' => __('Nieuwsbericht privé gepubliceerd.', 'sage'),
				'item_reverted_to_draft'   => __('Nieuwsbericht teruggekeerd naar concept.', 'sage'),
				'item_scheduled'           => __('Nieuwsbericht ingepland.', 'sage'),
				'item_updated'             => __('Nieuwsbericht bijgewerkt.', 'sage')
			],
			'admin_cols'  => [
				'image' => [
					'title'          => __('Featured image'),
					'width'          => 50,
					'height'         => 50,
					'featured_image' => 'thumbnail'
				],
				'title' => [
					'title' => __('Title')
				],
				'date',
				'author'
			]
		]
	]
];