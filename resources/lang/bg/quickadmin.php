<?php

return [
		'roles-permissions' => [		'title' => 'Roles & permissions',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'believers' => [		'title' => 'Believers',		'fields' => [			'first-name' => 'First Name',			'last-name' => 'Last Name',			'address' => 'Address',			'phone-number' => 'Phone Number',			'email' => 'Email',			'date-of-birth' => 'Date of Birth',		],	],
		'product-categories' => [		'title' => 'Product Categories',		'fields' => [			'category' => 'Category',		],	],
		'products' => [		'title' => 'Products',		'fields' => [			'product-name' => 'Product Name',			'product-category' => 'Product Category',			'product-description' => 'Product Description',			'in-stock' => 'In Stock',		],	],
		'product-deliveries' => [		'title' => 'Product Deliveries',		'fields' => [			'beleiver' => 'Beleivers Name',			'product' => 'Product Name',			'date' => 'Date',			'quantity' => 'Quantity',		],	],
		'product-orders' => [		'title' => 'Product Orders',		'fields' => [			'product' => 'Product Name',			'quantity' => 'Quantity',			'order-date' => 'Order Date',		],	],
	'qa_create' => 'Създай',
	'qa_save' => 'Запази',
	'qa_edit' => 'Промени',
	'qa_view' => 'Покажи',
	'qa_update' => 'Обнови',
	'qa_list' => 'Списък',
	'qa_no_entries_in_table' => 'Няма записи в таблицата',
	'qa_custom_controller_index' => 'Персонализиран контролер.',
	'qa_logout' => 'Изход',
	'qa_add_new' => 'Добави нов',
	'qa_are_you_sure' => 'Сигурни ли сте?',
	'qa_back_to_list' => 'Обратно към списъка',
	'qa_dashboard' => 'Табло',
	'qa_delete' => 'Изтрий',
	'quickadmin_title' => 'VGR Stock Management',
];