<?php

	return array(

		'enabled' => true,

		'route' => 'comments',

		'layout' => array(
			'set' => true,
			'name' => 'layouts.main',

		),
        
        'from' => array(
            'blocks' => array(
                'function' => 'block',
                'table' => 'block_comments',
                'column' => 'block_id',
                'model' => 'BlockLoves'
            ),
            'shares' => array(
                'function' => 'share',
                'table' => 'share_comments',
                'column' => 'share_id',
                'model' => 'ShareLoves'
            ),
        )
	);
