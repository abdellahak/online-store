<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lignes de validation
    |--------------------------------------------------------------------------
    |
    | Les lignes de validation suivantes contiennent les messages d'erreur par défaut
    | utilisés par la classe de validation. Certaines de ces règles possèdent plusieurs versions,
    | comme les règles de taille. N'hésitez pas à ajuster ces messages ici.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'accepted_if'          => 'Le champ :attribute doit être accepté lorsque :other est :value.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
    'alpha'                => 'Le champ :attribute ne doit contenir que des lettres.',
    'alpha_dash'           => 'Le champ :attribute ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
    'alpha_num'            => 'Le champ :attribute ne doit contenir que des lettres et des chiffres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
    'between'              => [
        'numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
        'file'    => 'Le champ :attribute doit peser entre :min et :max kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit contenir entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'La confirmation de :attribute ne correspond pas.',
    'current_password'     => 'Le mot de passe est incorrect.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals'          => 'Le champ :attribute doit être une date égale à :date.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'declined'             => 'Le champ :attribute doit être refusé.',
    'declined_if'          => 'Le champ :attribute doit être refusé lorsque :other est :value.',
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => 'Le champ :attribute a des dimensions d\'image invalides.',
    'distinct'             => 'Le champ :attribute contient une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse e-mail valide.',
    'ends_with'            => 'Le champ :attribute doit se terminer par l\'une des valeurs suivantes : :values.',
    'enum'                 => 'Le champ :attribute sélectionné est invalide.',
    'exists'               => 'Le champ :attribute sélectionné est invalide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'Le champ :attribute doit être supérieur à :value.',
        'file'    => 'Le champ :attribute doit être supérieur à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir plus de :value caractères.',
        'array'   => 'Le champ :attribute doit contenir plus de :value éléments.',
    ],
    'gte'                  => [
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
        'file'    => 'Le champ :attribute doit être supérieur ou égal à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir au moins :value caractères.',
        'array'   => 'Le champ :attribute doit contenir au moins :value éléments.',
    ],
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute sélectionné est invalide.',
    'in_array'             => 'Le champ :attribute n\'existe pas dans :other.',
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champ :attribute doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'Le champ :attribute doit être inférieur à :value.',
        'file'    => 'Le champ :attribute doit être inférieur à :value kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir moins de :value caractères.',
        'array'   => 'Le champ :attribute doit contenir moins de :value éléments.',
    ],
    'lte'                  => [
        'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
        'file'    => 'Le champ :attribute doit être inférieur ou égal à :value kilo-octets.',
        'string'  => 'Le champ :attribute ne doit pas contenir plus de :value caractères.',
        'array'   => 'Le champ :attribute ne doit pas contenir plus de :value éléments.',
    ],
    'mac_address'          => 'Le champ :attribute doit être une adresse MAC valide.',
    'max'                  => [
        'numeric' => 'Le champ :attribute ne doit pas être supérieur à :max.',
        'file'    => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
        'string'  => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        'array'   => 'Le champ :attribute ne doit pas contenir plus de :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes'            => 'Le champ :attribute doit être un fichier de type : :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute doit être au moins :min.',
        'file'    => 'Le champ :attribute doit peser au moins :min kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir au moins :min caractères.',
        'array'   => 'Le champ :attribute doit contenir au moins :min éléments.',
    ],
    'multiple_of'          => 'Le champ :attribute doit être un multiple de :value.',
    'not_in'               => 'Le champ :attribute sélectionné est invalide.',
    'not_regex'            => 'Le format du champ :attribute est invalide.',
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'password'             => 'Le mot de passe est incorrect.',
    'present'              => 'Le champ :attribute doit être présent.',
    'prohibited'           => 'Le champ :attribute est interdit.',
    'prohibited_if'        => 'Le champ :attribute est interdit lorsque :other est :value.',
    'prohibited_unless'    => 'Le champ :attribute est interdit sauf si :other est dans :values.',
    'prohibits'            => 'Le champ :attribute interdit la présence de :other.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_array_keys'  => 'Le champ :attribute doit contenir les entrées pour :values.',
    'required_if'          => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless'      => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all'    => 'Le champ :attribute est requis lorsque :values sont présents.',
    'required_without'     => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucun de :values n\'est présent.',
    'same'                 => 'Les champs :attribute et :other doivent correspondre.',
    'size'                 => [
        'numeric' => 'Le champ :attribute doit être :size.',
        'file'    => 'Le champ :attribute doit peser :size kilo-octets.',
        'string'  => 'Le champ :attribute doit contenir :size caractères.',
        'array'   => 'Le champ :attribute doit contenir :size éléments.',
    ],
    'starts_with'          => 'Le champ :attribute doit commencer par l\'une des valeurs suivantes : :values.',
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique'               => 'Le champ :attribute a déjà été utilisé.',
    'uploaded'             => 'Le champ :attribute n\'a pas pu être téléchargé.',
    'url'                  => 'Le champ :attribute doit être une URL valide.',
    'uuid'                 => 'Le champ :attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Messages de validation personnalisés
    |--------------------------------------------------------------------------
    |
    | Ici vous pouvez spécifier des messages de validation personnalisés pour
    | les attributs en utilisant la convention "attribut.règle" pour nommer
    | les lignes. Cela vous permet de spécifier rapidement un message personnalisé
    | pour une règle donnée.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'message-personnalisé',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Attributs de validation personnalisés
    |--------------------------------------------------------------------------
    |
    | Les lignes suivantes sont utilisées pour remplacer le placeholder d'attribut
    | par quelque chose de plus lisible, par exemple "Adresse e-mail" au lieu de "email".
    | Cela aide simplement à rendre nos messages plus explicites.
    |
    */

    'attributes' => [],

];
