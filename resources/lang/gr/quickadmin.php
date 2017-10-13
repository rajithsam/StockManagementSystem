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
	'qa_create' => 'Δημιουργία',
	'qa_save' => 'Αποθήκευση',
	'qa_edit' => 'Επεξεργασία',
	'qa_view' => 'Εμφάνιση',
	'qa_update' => 'Ενημέρωησ',
	'qa_list' => 'Λίστα',
	'qa_no_entries_in_table' => 'Δεν υπάρχουν δεδομένα στην ταμπέλα',
	'qa_custom_controller_index' => 'index προσαρμοσμένου controller.',
	'qa_logout' => 'Αποσύνδεση',
	'qa_add_new' => 'Προσθήκη νέου',
	'qa_are_you_sure' => 'Είστε σίγουροι;',
	'qa_back_to_list' => 'Επιστροφή στην λίστα',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Διαγραφή',
	'quickadmin_title' => 'VGR Stock Management',
];