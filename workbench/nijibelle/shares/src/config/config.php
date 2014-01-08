<?php

	return array(

		'enabled' => true,

		'route' => 'shares',

		'layout' => array(
			'set' => true,
			'name' => 'layouts.main',

		),
        
        'from' => array(
            'block' => array(
                'function' => 'blocks',
                'table' => 'share_blocks',
                'column'=>'block_id',
                'model' => 'ShareBlock',
            ),
        ),
	);
