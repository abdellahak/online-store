<?php
return [

    // Page d'accueil
    'home' => [

        // Page À propos
        'about' => [
            'text'=>'Bienvenue dans notre boutique en ligne ! Nous offrons un large choix de produits de qualité à des prix compétitifs. Notre mission est de vous garantir une expérience d\'achat fluide et agréable. Merci de nous avoir choisis pour vos besoins en shopping.',
            'title' => 'À propos de nous',
            'description' => "Ceci est une page à propos...",
            'developed_by' => 'Développé par : Abderrahim Besaid - Abdelilah Ouslimane - Ikram Gouskar - Abdellah Khouden',
        ],

        // Page d'index
        'index' => [
            'title' => 'Une boutique en ligne avec Laravel',
            'welcome' => 'Bienvenue dans notre boutique',
            'discover' => 'Découvrez des produits de qualité avec une livraison rapide et un service client exceptionnel.',
            'card1' => [
                'title' => 'Dernières Nouveautés',
                'description' => 'Explorez les dernières tendances et découvrez des produits uniques qui viennent d\'arriver dans notre boutique.',
                'button' => 'Acheter Maintenant',
            ],
            'card2' => [
                'title' => 'Paiement Rapide',
                'description' => 'Profitez d\'un processus de paiement fluide à chaque fois que vous effectuez un achat avec notre plateforme optimisée.',
                'button' => 'Commencer les Achats',
            ],
            'card3' => [
                'title' => 'Support 24/7',
                'description' => 'Obtenez de l\'aide quand vous en avez besoin avec notre équipe de support client dédiée, jour et nuit.',
                'button' => 'Contactez-nous',
            ],
        ],
    ],

    // Mises en page
    'layouts' => [

        //app
        'app' => [
            'home' => 'Accueil',
            'cart' => 'Panier',
            'about' => 'À propos',
            'products' => 'Produits',
            'login' => 'Connexion',
            'register' => 'Inscription',
            'my_orders' => 'Mes Commandes',

        ],

        //admin
        'admin' => [
            'logo' => 'Panneau d\'Administration',
            'dashboard' => 'Tableau de Bord',
            'categories' => 'Catégories',
            'suppliers' => 'Fournisseurs',
            'orders' => 'Commandes',
            'users' => 'Utilisateurs',
            'name' => 'Administrateur',
            'Sales' => 'Soldes',
            'products' => 'Produits',
            'rutern_home' => 'Retour à la page d\'accueil',

        ],

        // contenu partagé entre admin et app
        'shared' => [
            'footer' => 'Boutique en Ligne. Tous droits réservés.',
            'products' => 'Produits',
            'Logout' => 'Déconnexion',
        ]
    ],

    'products' => [

        // contenu partagé entre index et show
        'shared' => [
            'title' => 'Produits',
            'subtitle' => 'Liste des produits',
            'sales'=>'Afficher uniquement les ventes',
            'info' => '- Informations sur le produit',
        ],

        // index
        'index' => [
            'category' => [
                'filter' => [
                    'title' => 'Filtrer par catégorie',
                    'default' => 'Toutes',
                ],
                'empty' => [
                    'title' => 'Aucun produit trouvé',
                    'description' => 'Il n\'y a pas de produits disponibles pour la catégorie sélectionnée.'
                ],
                'discount'=>'Afficher uniquement les produits avec des remises'
            ],
            'product' => [
                'in_stock' => 'En stock',
                'out_of_stock' => 'Rupture de stock',
                'shop_now' => 'Acheter maintenant',
            ]
        ],

        // show
        'show' => [
            'details' => [
                'available' => 'Disponible :',
                'units' => 'unités',
                'Description' => 'Description',
                'stock' => 'Quantité en stock',
                'add_to_cart' => [
                    'quantity' => 'Quantité',
                    'add' => 'Ajouter au Panier',
                    'empty' => 'Ce produit est actuellement en rupture de stock'
                ],
                'features' => [
                    'card1' => [
                        'title' => 'Qualité Garantie',
                        'description' => 'Tous nos produits sont soigneusement sélectionnés pour leur qualité et leur durabilité.',
                    ],
                    'card2' => [
                        'title' => 'Paiement Sécurisé',
                        'description' => 'Plusieurs options de paiement avec un processus de paiement sécurisé.',
                    ],
                    'card3' => [
                        'title' => 'Livraison Rapide',
                        'description' => 'Traitement et expédition rapides pour toutes les commandes.',
                    ],
                ],
            ]
        ]
    ],
    'cart' => [

        // contenu partagé entre index et purchase
        'shared' => [
            'title' => 'Panier',
        ],

        'choose-payment'=> [
            'title' => 'Choisissez votre méthode de paiement',
            'cash' => 'Paiement à la livraison',
            'online' => 'Paiement en ligne',
            'amount'=> 'Montant à payer',
        ],

        // index
        'index' => [
            'title' => 'Votre Panier d\'Achat',
            'subtitle' => 'Liste des produits dans le panier',
            'balance' => 'Solde',
            'table' => [
                'headers' => [
                    'name' => 'Nom',
                    'price' => 'Prix',
                    'quantity' => 'Quantité',

                    
                ]
            ],
            'content' => [
                'clear' => 'Vider le Panier',
                'proceed' => 'Procéder au Paiement',
                'total' => 'Total à Payer',
            ],
            'empty' => [
                'title' => 'Votre Panier est Vide',
                'description' => "Il semble que vous n'ayez pas encore ajouté de produits à votre panier.",
                'link' => 'Continuer les Achats'
            ]
        ],

        // purchase
        'purchase' => [
            'success' => [
                'title' => 'Achat Terminé',
                'subtitle' => 'Votre commande a été complétée avec succès',
                'content' => [
                    'title' => 'Achat Terminé',
                    'congratulations' => 'Félicitations,',
                    'completed' => 'achat terminé. Le numéro de commande est '
                ]
            ]
        ],
    ],
    'admin' => [

        'err' => 'Veuillez corriger les erreurs suivantes :',

        'categories' => [
            'create' => [
                'title' => 'Créer une Nouvelle Catégorie',
                'form' => [
                    'name' => 'Nom de la Catégorie',
                    'description' => [
                        'label' => 'Description',
                        'explain' => 'Fournissez une brève description de cette catégorie'
                    ],
                    'btn' => [
                        'cancel' => 'Annuler',
                        'create' => 'Créer la Catégorie',
                        'edit' => 'Mettre à jour la Catégorie',
                        'delete' => 'Supprimer'
                    ]
                ]
            ],
            'edit' => [
                'title' => 'Modifier la Catégorie',
                'form' => [
                    'name' => 'Nom de la Catégorie',
                    'description' => 'Description',
                    'btn' => [
                        'cancel' => 'Annuler',
                        'create' => 'Mettre à jour la Catégorie'
                    ]
                ]
            ],
            'index' => [
                'title' => 'Catégories',
                'create' => 'Créer une Catégorie',
                'table' => [
                    'title' => 'Gérer les Catégories',
                    'subtitle' => 'Afficher, modifier et supprimer vos catégories',
                    'headers' => [
                        'name' => 'Nom',
                        'description' => 'Description',
                        'actions' => 'Actions',
                        'empty' => [
                            'title' => 'Aucune catégorie trouvée',
                            'link' => 'Créez votre première catégorie'
                        ],
                        'orders'=> [
                    'quantity' => 'Quantité',
                    'name' => 'Nom du produit',
                    'price' => 'Prix',
                    'total' => 'Total',
                    'date' => 'Date',
                    'id' => 'ID de commande',
                ]
                    ]
                ]
            ],
        ],
        'product' => [
            'edit' => [
                'title' => 'Modifier le Produit',
                'form' => [
                    'name' => 'Nom',
                    'price' => 'Prix',
                    'image' => 'Image',
                    'quantity' => 'Quantité',
                    'category' => 'Nom de la catégorie',
                    'supplier' => 'Nom du fournisseur',
                    'description' => 'Description',
                    'btn_update' => 'Modifier',
                ]
            ],
            'index' => [
                'create_title' => 'Créer des produits',
                'form' => [
                    'name' => 'Nom',
                    'price' => 'Prix',
                    'image' => 'Image',
                    'quantity' => 'Quantité',
                    'category' => 'Nom de la catégorie',
                    'supplier' => 'Nom du fournisseur',
                    'description' => 'Description',
                    'btn_submit' => 'Soumettre',
                ],
                'table' => [
                    'id' => 'ID',
                    'name' => 'Nom',
                    'category' => 'Nom de la catégorie',
                    'supplier' => 'Nom du fournisseur',
                    'price' => 'Prix',
                    'discounted_price' => 'Prix remisé',
                    'quantity' => 'Quantité',
                    'edit' => 'Modifier',
                    'delete' => 'Supprimer',
                ],
                'filter_category' => 'Filtrer par catégorie :',
                'filter_supplier' => 'Filtrer par fournisseur :',
                'all_categories' => 'Toutes les catégories',
                'all_suppliers' => 'Tous les fournisseurs',
                'export_csv' => 'Exporter CSV',
                'import_csv' => 'Importer CSV',
                'manage_title' => 'Gérer les Produits',
                'pagination_showing' => 'Affichage',
                'pagination_to' => 'à',
                'pagination_of' => 'de',
                'pagination_products' => 'produits',
                'pagination_page' => 'Page',
                'pagination_of2' => 'de',
            ]
        ],
        'home' => [
            'index' => [
                'title' => 'Page d\'Administration - Administration',
                'welcome' => [
                    'title' => 'Bienvenue dans le Tableau de Bord d\'Administration',
                    'subtitle' => 'Gérez votre boutique, vos produits et vos catégories depuis un seul endroit',
                    'description' => "Utilisez la navigation dans la barre latérale pour accéder aux différentes sections du panneau d'administration. De là, vous pouvez gérer vos produits, vos catégories et surveiller les performances de votre boutique.",
                    'nav' => [
                        'products' => 'Gérer les Produits',
                        'categories' => 'Gérer les Catégories',
                        'orders' => 'Voir les Commandes'
                    ]

                ],
                'stats' => [
                    'products' => [
                        'title' => 'Total des Produits',
                        'unavailable' => 'Indisponible',
                    ],
                    'categories' => [
                        'title' => 'Total des Catégories',
                        'unavailable' => 'Indisponible',
                    ],
                    'orders' => [
                        'title' => 'Total des Commandes',
                        'unavailable' => 'Indisponible',
                    ],
                    'Revenue' => [
                        'title' => 'Revenus',
                        'unavailable' => 'Indisponible',
                    ],
                    'activity' => [
                        'title' => 'Activité Récente',
                        'description' => 'Votre activité récente apparaîtra ici.',
                    ]
                ]
            ]
        ],
        'suppliers' => [
            'index' => [
                'create' => 'Créer un Fournisseur',
                'title' => 'Fournisseurs',
                'subtitle' => 'Gérer les Fournisseurs',
                'pagination_showing' => 'Affichage',
                'pagination_to' => 'à',
                'pagination_of' => 'de',
                'pagination_suppliers' => 'fournisseurs',
                'pagination_page' => 'Page',
                'pagination_of2' => 'de',
                'table' => [
                    'headers' => [
                        'raison_social' => 'Raison sociale',
                        'address' => 'Adresse',
                        'telephone' => 'Téléphone',
                        'email' => 'Email',
                        'products' => 'Produits',
                        'description' => 'Description',
                    ],
                    'btn' => [
                        'edit' => 'Modifier',
                    ]
                ]
            ],
            'create' => [
                'title' => 'Créer un Nouveau Fournisseur',
                'raison_social' => 'Raison sociale',
                'address' => 'Adresse',
                'telephone' => 'Téléphone',
                'email' => 'Email',
                'description' => 'Description',
                'btn_submit' => 'Soumettre',
                'btn_up' => 'Edite',
                'btn_de' => 'Supprimer',
            ],
            'edit' => [
                'title' => 'Modifier le Fournisseur',
                'raison_social' => 'Raison sociale',
                'address' => 'Adresse',
                'telephone' => 'Téléphone',
                'email' => 'Email',
                'description' => 'Description',
                'btn' => 'Mettre à jour',
                'btn_up' => 'Edite',
                'btn_de' => 'Supprimer',
            ],
            'show' => []
        ],
        'soldes'=>[
            'index'=>[
                'create_title' => 'Créer des produits',
                'value' => 'Valeur',
                'starts_at' => 'Date de début',
                'ends_at' => 'Date de fin',
                'product' => 'Nom du produit',
                'category' => 'Nom de la catégorie',
                'select_product' => 'Sélectionner un produit',
                'select_category' => 'Sélectionner une catégorie',
                'btn_submit' => 'Soumettre',
                'manage_title' => 'Gérer les soldes',
                'table' => [
                    'id' => 'ID',
                    'product' => 'Produit',
                    'category' => 'Catégorie',
                    'discount' => 'Remise (%)',
                    'start' => 'Date de début',
                    'end' => 'Date de fin',
                    'edit' => 'Modifier',
                    'delete' => 'Supprimer',
                ],
            ],
            'edit'=>[
                'title'=>'Modifier le solde',
                'value'=>'Taux (%)',
                'starts_at'=>'Date début',
                'ends_at'=>'Date fin',
                'product'=>'Produit',
                'select_product'=>'-- Aucun --',
                'category'=>'Catégorie',
                'select_category'=>'-- Aucune --',
                'btn'=>'Mettre à jour'
            ],
        ],
        'orders' => [
            'manage_title'=>'Gérer les commandes',
            'table'=>[
                'id'=>'ID',
                'total'=>'Total',
                'user'=>'Nom d\'utilisateur',
                'status'=>'Statut',
                'payment_type'=>'Type de paiement',
                'delete'=>'Supprimer',
            ],
            'status_options'=>[
                'packed'=>'Emballé',
                'sent'=>'Envoyé',
                'on_way'=>'En route',
                'received'=>'Reçu',
                'returned'=>'Retournée',
                'closed'=>'Fermée',
            ],
            'payment'=>[
                'cod'=>'Paiement à la livraison',
                'paid'=>'Payé',
            ],
            'btn_delete'=>'Supprimer',
            'pagination'=>[
                'showing'=>'Affichage',
                'to'=>'à',
                'of'=>'de',
                'orders'=>'commandes',
                'page'=>'Page',
                'of2'=>'de',
            ]
        ],
        // users
        'users'=>[
            'create_title'=>'Créer un utilisateur',
            'edit_title'=>'Modifier l\'utilisateur',
            'manage_title'=>'Gérer les utilisateurs',
            'form'=>[
                'name'=>'Nom',
                'email'=>'Email',
                'password'=>'Mot de passe',
                'password_confirmation'=>'Confirmer le mot de passe',
                'balance'=>'Solde',
                'role'=>'Rôle',
                'is_super_admin'=>'Super administrateur ?',
                'leave_blank'=>'Laisser vide pour conserver le mot de passe actuel.',
                'submit'=>'Soumettre',
                'update'=>'Mettre à jour',
                'cancel'=>'Annuler',
            ],
            'table'=>[
                'id'=>'ID',
                'name'=>'Nom',
                'email'=>'Email',
                'role'=>'Rôle',
                'super_admin'=>'Super administrateur',
                'balance'=>'Solde',
                'edit'=>'Modifier',
                'delete'=>'Supprimer',
            ],
            'yes'=>'Oui',
            'no'=>'Non',
            'delete_confirm'=>'Êtes-vous sûr de vouloir supprimer cet utilisateur ?',
            'pagination'=>[
                'showing'=>'Affichage',
                'to'=>'à',
                'of'=>'de',
                'users'=>'utilisateurs',
                'page'=>'Page',
                'of2'=>'de',
            ]
        ],
    ],
    'auth' => [
        'register' => [
            'title' => 'Créer un nouveau compte',
            'helper' => [
                'or' => 'ou',
                'link' => ' vous connecter avec un compte existant',
            ],
            'form' => [
                'name' => 'Nom',
                'email' => 'Email',
                'password' => 'Mot de passe',
                'password_confirmation' => 'Confirmer le mot de passe',
                'create' => ' Créer un compte',
            ]
        ],
        'login' => [
            'title' => 'Connexion',
            'subtitle' => 'Se connecter à votre compte',
            'form' => [
                'email' => 'Email',
                'password' => 'Mot de passe',
                'remember' => 'Se souvenir de moi',
                'forgot' => 'Mot de passe oublié?',
                'login' => 'Se connecter',
            ]
        ],
        'verify' => [
            'title'         => 'Vérifier votre adresse e-mail',
            'resent_alert'  => 'Un lien de vérification frais a été envoyé à votre adresse e-mail.',
            'instruction'   => 'Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.',
            'not_received'  => 'Si vous n\'avez pas reçu l\'email,',
            'resend'        => 'cliquez ici pour demander un autre',
            'return'        => [
                'text'  => 'Retourner à la page',
                'login' => 'de connexion',
            ],
        ],
        'password_confirm' => [
            'header'      => 'Confirmer le mot de passe',
            'instruction' => 'Veuillez confirmer votre mot de passe avant de continuer.',
            'form'        => [
                'password_label' => 'Mot de passe',
                'confirm_button' => 'Confirmer le mot de passe',
                'forgot_link'    => 'Mot de passe oublié?',
            ],
        ],
        'password_reset' => [
            'header' => 'Réinitialiser le mot de passe',
            'form'   => [
                'email_label'   => 'Adresse e-mail',
                'submit_button' => 'Envoyer le lien de réinitialisation du mot de passe',
            ],
        ],
        'password_update' => [
            'header' => 'Réinitialiser le mot de passe',
            'form'   => [
                'email_label'           => 'Adresse e-mail',
                'password_label'        => 'Mot de passe',
                'password_confirmation' => 'Confirmer le mot de passe',
                'submit_button'         => 'Réinitialiser le mot de passe',
            ],
        ],

    ],
    'dashboard' => [
        'quick_links' => 'Liens rapides',
        'overview' => 'Vue d\'ensemble du tableau de bord',
        'overview_desc' => 'Voir les indicateurs clés de performance et les graphiques pour la période sélectionnée.',
        'period_revenue' => 'Revenu de la période',
        'orders' => 'Commandes',
        'products_sold' => 'Produits vendus',
        'avg_order_amount' => 'Montant moyen de commande',
        'revenue_by_month_chart' => 'Revenu par mois (Graphique)',
        'revenue_by_day_chart' => 'Revenu par jour (Graphique)',
        'top_products_chart' => 'Meilleurs produits par revenu (Graphique)',
        'revenue_by_category_chart' => 'Revenu par catégorie (Graphique)',
        'revenue_by_day' => 'Revenu par jour',
        'revenue_by_month' => 'Revenu par mois (pour la période sélectionnée uniquement)',
        'top_products' => 'Meilleurs produits par revenu',
        'revenue_by_category' => 'Revenu par catégorie',
        'revenue_by_year' => 'Revenu par année (pour la période sélectionnée uniquement)',
        'date' => 'Date',
        'month' => 'Mois',
        'year' => 'Année',
        'revenue' => 'Revenu',
        'products_sold_col' => 'Produits vendus',
        'product' => 'Produit',
        'category' => 'Catégorie',
        'start_date' => 'Date de début',
        'end_date' => 'Date de fin',
        'filter' => 'Filtrer',
        'reset' => 'Réinitialiser',
        'download_pdf' => 'Télécharger PDF',
    ],

];
