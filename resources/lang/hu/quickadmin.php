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
	'qa_create' => 'Létrehozás',
	'qa_save' => 'Mentés',
	'qa_edit' => 'Szerkesztés',
	'qa_view' => 'Megtekintés',
	'qa_update' => 'Frissítés',
	'qa_list' => 'Lista',
	'qa_no_entries_in_table' => 'Nincs bejegyzés a táblában',
	'qa_logout' => 'Kijelentkezés',
	'qa_add_new' => 'Új hozzáadása',
	'qa_are_you_sure' => 'Biztosan így legyen?',
	'qa_back_to_list' => 'Vissza a listához',
	'qa_dashboard' => 'Vezérlőpult',
	'qa_delete' => 'Törlés',
	'qa_custom_controller_index' => 'Egyedi vezérlő index.',
	'quickadmin_title' => 'VGR Stock Management',
];