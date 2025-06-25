<?php
return [

    // Home Page
    'home' => [

        // About Page
        'about' => [
            'text'=>'Welcome to our Online Store! We offer a wide selection of quality products at competitive prices. Our mission is to provide a seamless and enjoyable shopping experience for all our customers. Thank you for choosing us for your shopping needs.',
            'about_title' => 'About us',
            'about_description' => 'This is an about page...',
            'developed_by' => 'Developed by: abderrahim besaid - abdelilah ouslimane - ikram gouskar - abdellah khouden',
        ],

        // Index Page
        'index' => [
            'title'=>'A Laravel Online Store',
            'welcome' => 'Welcome to our store',
            'discover' => 'Discover quality products with fast shipping and exceptional customer service.',
            'card1' => [
                'title' => 'Newest Arrivals',
                'description' => 'Explore the latest trends and discover unique products that just landed in our store.',
                'button' => 'Shop Now',
            ],
            'card2' => [
                'title' => 'Fast Checkout',
                'description' => 'Experience a seamless checkout process every time you shop with our optimized platform.',
                'button' => 'Start Shopping',
            ],
            'card3' => [
                'title' => '24/7 Support',
                'description' => 'Get assistance whenever you need help with our dedicated customer support team, day or night.',
                'button' => 'Contact Us',
            ],
        ],
      
    ],

    // Layouts
    'layouts' => [

        //app
        'app' => [
            'home' => 'Home',
            'cart' => 'Cart',
            'about' => 'About',
            'login' => 'Login',
            'products' => 'Products',
            'register' => 'Register',
            'my_orders' => 'My Orders',

        ],

        //admin
        'admin' => [
            'logo' => 'Admin Panel',
            'dashboard' => 'Dashboard',
            'categories' => 'Categories',
            'suppliers' => 'Suppliers',
            'orders' => 'Orders',
            'users' => 'Users',
            'soldes'=>'Sales',
            'products' => 'Products',
            'rutern_home'=>'Go back to the home page',
            'name' => 'Admin User'
        ],

        // shared content between admin and app
        'shared' => [
            'footer' => 'Online Store. All rights reserved.',
            'products' => 'Products',
            'Logout' => 'Logout',
        ]
    ],

    'products' => [

        // shared content between index and show
        'shared' => [
            'title' => 'Products',
            'subtitle' => 'List of products',
            'sales'=>'Show Only Sales',
            'info' => '- Product information'
        ],

        // index
        'index' => [
            'category' => [
                'filter' => [
                    'title' => 'Filter by category',
                    'default' => 'All',
                ],
                'empty' => [
                    'title' => 'No products found',
                    'description' => 'There are no products available for the selected category.'
                ],
                'discount'=>'Show only products with discounts'
            ],
            'product' => [
                'in_stock' => 'In stock',
                'out_of_stock' => 'Out of stock',
                'shop_now' => 'Shop now',
            ]
        ],

        // show
        'show' => [
            'details' => [
                'available' => 'Available:',
                'units' => 'units',
                'Description' => 'Description',
                'stock' => 'Quantity in Stock',
                'add_to_cart' => [
                    'quantity' => 'Quantity',
                    'add' => 'Add to Cart',
                    'empty' => 'This product is currently out of stock'
                ],
                'features' => [
                    'card1' => [
                        'title' => 'Quality Guaranteed',
                        'description' => 'All our products are carefully selected for quality and durability.',
                    ],
                    'card2' => [
                        'title' => 'Secure Payment',
                        'description' => 'Multiple payment options with secure checkout process.',
                    ],
                    'card3' => [
                        'title' => 'Fast Delivery',
                        'description' => 'Quick processing and shipping for all orders.',
                    ],
                ],
            ]
        ]
    ],
    'cart' => [

        // shared content between index and purchase
        'shared' => [
            'title' => 'Cart',
        ],

        'choose-payment'=> [
            'title' => 'Choose your payment method',
            'cash' => 'Cash on delivery',
            'online' => 'Online payment',
            'amount'=> 'amount to be paid',
        ],

        // index
        'index' => [
            'title' => 'Your Shopping Cart',
            'subtitle' => 'List of products in cart',
            'balance' => 'Your Balance',
            'table' => [
                'headers' => [
                    'name' => 'Name',
                    'price' => 'Price',
                    'quantity' => 'Quantity',
                ]
            ],
            'content' => [
                'clear' => 'Clear Cart',
                'proceed' => 'Proceed to Checkout',
                'total' => "Total to Pay",
            ],
            'empty' => [
                'title' => 'Your Cart is Empty',
                'description' => "Looks like you haven't added any products to your cart yet.",
                'link' => 'Continue Shopping'
            ]
        ],

        // purchase
        'purchase' => [
            'success' => [
                'title' => 'Purchase Completed',
                'subtitle' => 'Your order has been successfully completed',
                'content' => [
                    'title' => 'Purchase Completed',
                    'congratulations' => 'Congratulations,',
                    'completed' => 'purchase completed. Order number is '
                ]
            ]
        ],
    ],
    'admin' => [

        'err' => 'Please correct the following errors:',

        // categories
        'categories' => [

            // create
            'create' => [
                'title' => 'Create New Category',
                'form' => [
                    'name' => 'Category Name',
                    'description' => [
                        'label' => 'Description',
                        'explain' => 'Provide a brief description of this category'
                    ],
                    'btn' => [
                        'cancel' => 'Cancel',
                        'create' => 'Create Category',
                        'edit' => 'Edit',
                        'delete' => 'Delete'
                    ]
                ]
            ],

            // edit
            'edit' => [
                'title' => 'Edit Category',
                'form' => [
                    'name' => 'Category Name',
                    'description' => 'Description',
                    'btn' => [
                        'cancel' => 'Cancel',
                        'create' => 'Update Category'
                    ]
                ]
            ],

            // index
            'index' => [
                'title' => 'Categories',
                'create' => 'Create Category',
                'table' => [
                    'title' => 'Manage Categories',
                    'subtitle' => 'View, edit and delete your categories',
                    'headers' => [
                        'name' => 'Name',
                        'description' => 'Description',
                        'actions' => 'Actions',
                        'empty' => [
                            'title' => 'No categories found',
                            'link' => 'Create your first category'
                        ]
                    ]
                ]
            ],
        ],

        // products
        'product' => [

            // edit
            'edit' => [
                'title' => 'Edit Product',
                'form' => [
                    'name' => 'Name',
                    'price' => 'Price',
                    'image' => 'Image',
                    'quantity' => 'Quantity',
                    'category' => 'Category Name',
                    'supplier' => 'Supplier Name',
                    'description' => 'Description',
                    'btn_update' => 'Edit',
                ]
            ],



            // index
            'index' => [
                'create_title' => 'Create Products',
                'form' => [
                    'name' => 'Name',
                    'price' => 'Price',
                    'image' => 'Image',
                    'quantity' => 'Quantity',
                    'category' => 'Category Name',
                    'supplier' => 'Supplier Name',
                    'description' => 'Description',
                    'btn_submit' => 'Submit',
                ],
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'category' => 'Category Name',
                    'supplier' => 'Supplier Name',
                    'price' => 'Price',
                    'discounted_price' => 'Discounted Price',
                    'quantity' => 'Quantity',
                    'edit' => 'Edit',
                    'delete' => 'Delete',
                ],
                'filter_category' => 'Filter by Category:',
                'filter_supplier' => 'Filter by Supplier:',
                'all_categories' => 'All Categories',
                'all_suppliers' => 'All Suppliers',
                'export_csv' => 'Export CSV',
                'import_csv' => 'Import CSV',
                'manage_title' => 'Manage Products',
                'pagination_showing' => 'Showing',
                'pagination_to' => 'to',
                'pagination_of' => 'of',
                'pagination_products' => 'products',
                'pagination_page' => 'Page',
                'pagination_of2' => 'of',
            ]
        ],

        // home
        'home' => [

            // index
            'index' => [
                "title" => "Admin Page - Admin",
                'welcome' => [
                    'title' => 'Welcome to the Admin Dashboard',
                    'subtitle' => 'Manage your store, products, and categories from one place',
                    'description' => "Use the sidebar navigation to access different sections of the admin panel. From here, you can manage your products, categories, and monitor your store's performance.",
                    'nav' => [
                        'products' => 'Manage Products',
                        'categories' => 'Manage Categories',
                        'orders' => 'View Orders'
                    ]

                ],
                'stats' => [
                    'products' => [
                        'title' => 'Total Products',
                        'unavailable' => 'Unavailable',
                    ],
                    'categories' => [
                        'title' => 'Total Categories',
                        'unavailable' => 'Unavailable',
                    ],
                    'orders' => [
                        'title' => 'Total Orders',
                        'unavailable' => 'Unavailable',
                    ],
                    'Revenue' => [
                        'title' => 'Revenue',
                        'unavailable' => 'Unavailable',
                    ],
                    'activity' => [
                        'title' => 'Recent Activity',
                        'description' => 'Your recent activity will appear here.',
                    ]
                ]
            ]
        ],

        // suppliers
        'suppliers' => [

            // index
            'index' => [
                'create' => 'Create Supplier',
                'title' => 'Suppliers',
                'subtitle' => 'Manage Suppliers',
                'pagination_showing' => 'Showing',
                'pagination_to' => 'to',
                'pagination_of' => 'of',
                'pagination_suppliers' => 'suppliers',
                'pagination_page' => 'Page',
                'pagination_of2' => 'of',
                'table' => [
                    'headers' => [
                        'raison_social' => 'Raison social',
                        'address' => 'Address',
                        'telephone' => 'Telephone',
                        'email' => 'Email',
                        'products' => 'Products',
                        'description' => 'Description',
                    ],
                    'btn' => [
                        'edit' => 'Edit',
                    ]
                ]
            ],

            // create
            'create' => [
                'title' => 'Create Supplier',
                'raison_social' => 'Raison social',
                'address' => 'Address',
                'telephone' => 'Telephone',
                'email' => 'Email',
                'description' => 'Description',
                'btn_submit' => 'Submit',
                'btn_up' => 'Update',
                'btn_de' => 'Delete',
            ],

            // edit
            'edit' => [
                'title' => 'Edit Supplier',
                'raison_social' => 'Raison social',
                'address' => 'Address',
                'telephone' => 'Telephone',
                'email' => 'Email',
                'description' => 'Description',
                'btn' => 'Update',
                'btn_up' => 'Update',
                'btn_de' => 'Delete',
            ],

            // show
            'show' => []
        ],

        'soldes'=>[
            'index'=>[
                'create_title' => 'Create Products',
                'value' => 'Value',
                'starts_at' => 'Start Date',
                'ends_at' => 'End Date',
                'product' => 'Product Name',
                'category' => 'Category Name',
                'select_product' => 'Select Product',
                'select_category' => 'Select Category',
                'btn_submit' => 'Submit',
                'manage_title' => 'Manage Soldes',
                'table' => [
                    'id' => 'ID',
                    'product' => 'Product',
                    'category' => 'Category',
                    'discount' => 'Discount (%)',
                    'start' => 'Start Date',
                    'end' => 'End Date',
                    'edit' => 'Edit',
                    'delete' => 'Delete',
                ],
            ],
            'edit'=>[
                'title'=>'Edit Solde',
                'value'=>'Discount (%)',
                'starts_at'=>'Start Date',
                'ends_at'=>'End Date',
                'product'=>'Product',
                'select_product'=>'-- None --',
                'category'=>'Category',
                'select_category'=>'-- None --',
                'btn'=>'Update'
            ],
        ],

        // orders
        'orders'=>[
            'manage_title'=>'Manage Orders',
            'table'=>[
                'id'=>'ID',
                'total'=>'Total',
                'user'=>'User Name',
                'status'=>'Status',
                'payment_type'=>'Payment Type',
                'delete'=>'Delete',
            ],
            'status_options'=>[
                'packed'=>'Packed',
                'sent'=>'Sent',
                'on_way'=>'On the way',
                'received'=>'Received',
                'returned'=>'Returned',
                'closed'=>'Closed',
            ],
            'payment'=>[
                'cod'=>'Cash on Delivery',
                'paid'=>'Paid',
            ],
            'btn_delete'=>'Delete',
            'pagination'=>[
                'showing'=>'Showing',
                'to'=>'to',
                'of'=>'of',
                'orders'=>'orders',
                'page'=>'Page',
                'of2'=>'of',
            ]
        ],

        // users
        'users'=>[
            'create_title'=>'Create User',
            'edit_title'=>'Edit User',
            'manage_title'=>'Manage Users',
            'form'=>[
                'name'=>'Name',
                'email'=>'Email',
                'password'=>'Password',
                'password_confirmation'=>'Confirm Password',
                'balance'=>'Balance',
                'role'=>'Role',
                'is_super_admin'=>'Is Super Admin?',
                'leave_blank'=>'Leave blank to keep current password.',
                'submit'=>'Submit',
                'update'=>'Update',
                'cancel'=>'Cancel',
            ],
            'table'=>[
                'id'=>'ID',
                'name'=>'Name',
                'email'=>'Email',
                'role'=>'Role',
                'super_admin'=>'Super Admin',
                'balance'=>'Balance',
                'edit'=>'Edit',
                'delete'=>'Delete',
            ],
            'yes'=>'Yes',
            'no'=>'No',
            'delete_confirm'=>'Are you sure you want to delete this user?',
            'pagination'=>[
                'showing'=>'Showing',
                'to'=>'to',
                'of'=>'of',
                'users'=>'users',
                'page'=>'Page',
                'of2'=>'of',
            ]
        ],
    ],
    'auth' => [
        'register' => [
            'title' => 'Create a new account',
            'helper' => [
                'or' => 'or',
                'link' => ' sign in to existing account',
            ],
            'form' => [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password',
                'create' => ' Create Account',
            ]
        ],
        'login' => [
            'title' => 'Login',
            'subtitle' => 'Sign in to your account',
            'form' => [
                'email' => 'Email',
                'password' => 'Password',
                'remember' => 'Remember me',
                'forgot' => 'Forgot your password?',
                'login' => 'sign in',
            ]
        ],
        'verify' => [
            'title'         => 'Verify Your Email Address',
            'resent_alert'  => 'A fresh verification link has been sent to your email address.',
            'instruction'   => 'Before proceeding, please check your email for a verification link.',
            'not_received'  => 'If you did not receive the email,',
            'resend'        => 'click here to request another',
            'return'        => [
                'text'  => 'Return to',
                'login' => 'login page',
            ],
        ],
        'password_confirm' => [
            'header'      => 'Confirm Password',
            'instruction' => 'Please confirm your password before continuing.',
            'form'        => [
                'password_label' => 'Password',
                'confirm_button' => 'Confirm Password',
                'forgot_link'    => 'Forgot Your Password?',
            ],
        ],
        'password_reset' => [
            'header' => 'Reset Password',
            'form'   => [
                'email_label'   => 'Email Address',
                'submit_button' => 'Send Password Reset Link',
            ],
        ],
        'password_update' => [
            'header' => 'Reset Password',
            'form'   => [
                'email_label'           => 'Email Address',
                'password_label'        => 'Password',
                'password_confirmation' => 'Confirm Password',
                'submit_button'         => 'Reset Password',
            ],
        ],
    ],

    'dashboard' => [
        'quick_links' => 'Quick Links',
        'overview' => 'Dashboard Overview',
        'overview_desc' => 'View key performance indicators and charts for the selected period.',
        'period_revenue' => 'Period Revenue',
        'orders' => 'Orders',
        'products_sold' => 'Products Sold',
        'avg_order_amount' => 'Avg Order Amount',
        'revenue_by_month_chart' => 'Revenue by Month (Chart)',
        'revenue_by_day_chart' => 'Revenue by Day (Chart)',
        'top_products_chart' => 'Top Products by Revenue (Chart)',
        'revenue_by_category_chart' => 'Revenue by Category (Chart)',
        'revenue_by_day' => 'Revenue by Day',
        'revenue_by_month' => 'Revenue by Month (for the selected period only)',
        'top_products' => 'Top Products by Revenue',
        'revenue_by_category' => 'Revenue by Category',
        'revenue_by_year' => 'Revenue by Year (for the selected period only)',
        'date' => 'Date',
        'month' => 'Month',
        'year' => 'Year',
        'revenue' => 'Revenue',
        'products_sold_col' => 'Products Sold',
        'product' => 'Product',
        'category' => 'Category',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'filter' => 'Filter',
        'reset' => 'Reset',
        'download_pdf' => 'Download PDF',
    ],

    'my_orders' => [
        'order' => 'Order',
        'date' => 'Date',
        'total' => 'Total',
        'id' => 'ID',
        'name' => 'Product',
        'price' => 'Price',
        'quantity' => 'Quantity',
        'empty' => 'Seems to be that you have not purchased anything in our store =(.',
    ],

];
