<?php

return [

    /*
    |--------------------------------------------------------------------------
    | أسطر التحقق
    |--------------------------------------------------------------------------
    |
    | تحتوي الأسطر التالية على رسائل الخطأ الافتراضية المستخدمة من قبل فئة التحقق.
    | بعض هذه القواعد تحتوي على إصدارات متعددة، مثل قواعد الحجم.
    | لا تتردد في تعديل هذه الرسائل بما يتناسب مع تطبيقك.
    |
    */

    'accepted'             => 'يجب قبول الحقل :attribute.',
    'accepted_if'          => 'يجب قبول الحقل :attribute عندما يكون :other هو :value.',
    'active_url'           => 'الحقل :attribute ليس عنوان URL صالحاً.',
    'after'                => 'يجب أن يكون الحقل :attribute تاريخاً بعد :date.',
    'after_or_equal'       => 'يجب أن يكون الحقل :attribute تاريخاً بعد أو يساوي :date.',
    'alpha'                => 'يجب أن يحتوي الحقل :attribute على أحرف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي الحقل :attribute على أحرف، أرقام، شرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'يجب أن يحتوي الحقل :attribute على أحرف وأرقام فقط.',
    'array'                => 'يجب أن يكون الحقل :attribute مصفوفة.',
    'before'               => 'يجب أن يكون الحقل :attribute تاريخاً قبل :date.',
    'before_or_equal'      => 'يجب أن يكون الحقل :attribute تاريخاً قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'يجب أن يكون الحقل :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف الحقل :attribute بين :min و :max حرفاً.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على بين :min و :max عناصر.',
    ],
    'boolean'              => 'يجب أن يكون الحقل :attribute صحيحاً أو خاطئاً.',
    'confirmed'            => 'تأكيد الحقل :attribute غير مطابق.',
    'current_password'     => 'كلمة المرور غير صحيحة.',
    'date'                 => 'الحقل :attribute ليس تاريخاً صالحاً.',
    'date_equals'          => 'يجب أن يكون الحقل :attribute تاريخاً مساوياً لـ :date.',
    'date_format'          => 'لا يتطابق الحقل :attribute مع الشكل :format.',
    'declined'             => 'يجب رفض الحقل :attribute.',
    'declined_if'          => 'يجب رفض الحقل :attribute عندما يكون :other هو :value.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يحتوي الحقل :attribute على :digits أرقام.',
    'digits_between'       => 'يجب أن يحتوي الحقل :attribute على بين :min و :max أرقام.',
    'dimensions'           => 'الأبعاد الخاصة بالحقل :attribute غير صالحة.',
    'distinct'             => 'يحتوي الحقل :attribute على قيمة مكررة.',
    'email'                => 'يجب أن يكون الحقل :attribute عنوان بريد إلكتروني صالحاً.',
    'ends_with'            => 'يجب أن ينتهي الحقل :attribute بأحد القيم التالية: :values.',
    'enum'                 => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'exists'               => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'file'                 => 'يجب أن يكون الحقل :attribute ملفاً.',
    'filled'               => 'يجب أن يحتوي الحقل :attribute على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يحتوي الحقل :attribute على أكثر من :value حروف.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على أكثر من :value عناصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من أو يساوي :value.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يحتوي الحقل :attribute على :value حرفاً على الأقل.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على :value عناصر على الأقل.',
    ],
    'image'                => 'يجب أن يكون الحقل :attribute صورة.',
    'in'                   => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'in_array'             => 'الحقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون الحقل :attribute عدداً صحيحاً.',
    'ip'                   => 'يجب أن يكون الحقل :attribute عنوان IP صالحاً.',
    'ipv4'                 => 'يجب أن يكون الحقل :attribute عنوان IPv4 صالحاً.',
    'ipv6'                 => 'يجب أن يكون الحقل :attribute عنوان IPv6 صالحاً.',
    'json'                 => 'يجب أن يكون الحقل :attribute سلسلة JSON صالحة.',
    'lt'                   => [
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من :value.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute أقل من :value كيلوبايت.',
        'string'  => 'يجب أن يحتوي الحقل :attribute على أقل من :value حروف.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على أقل من :value عناصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من أو يساوي :value.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute أقل من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب ألا يحتوي الحقل :attribute على أكثر من :value حروف.',
        'array'   => 'يجب ألا يحتوي الحقل :attribute على أكثر من :value عناصر.',
    ],
    'mac_address'          => 'يجب أن يكون الحقل :attribute عنوان MAC صالحاً.',
    'max'                  => [
        'numeric' => 'يجب ألا يكون الحقل :attribute أكبر من :max.',
        'file'    => 'يجب ألا يتجاوز حجم الحقل :attribute :max كيلوبايت.',
        'string'  => 'يجب ألا يتجاوز عدد حروف الحقل :attribute :max حرفاً.',
        'array'   => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max عناصر.',
    ],
    'mimes'                => 'يجب أن يكون الحقل :attribute ملفاً من نوع: :values.',
    'mimetypes'            => 'يجب أن يكون الحقل :attribute ملفاً من نوع: :values.',
    'min'                  => [
        'numeric' => 'يجب أن يكون الحقل :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يحتوي الحقل :attribute على الأقل :min حروف.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل :min عناصر.',
    ],
    'multiple_of'          => 'يجب أن يكون الحقل :attribute من مضاعفات :value.',
    'not_in'               => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'not_regex'            => 'صيغة الحقل :attribute غير صالحة.',
    'numeric'              => 'يجب أن يكون الحقل :attribute رقماً.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب أن يكون الحقل :attribute موجوداً.',
    'prohibited'           => 'الحقل :attribute محظور.',
    'prohibited_if'        => 'الحقل :attribute محظور عندما يكون :other هو :value.',
    'prohibited_unless'    => 'الحقل :attribute محظور ما لم يكن :other موجوداً في :values.',
    'prohibits'            => 'الحقل :attribute يمنع وجود :other.',
    'regex'                => 'صيغة الحقل :attribute غير صالحة.',
    'required'             => 'الحقل :attribute مطلوب.',
    'required_array_keys'  => 'يجب أن يحتوي الحقل :attribute على الإدخالات التالية: :values.',
    'required_if'          => 'الحقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless'      => 'الحقل :attribute مطلوب ما لم يكن :other موجوداً في :values.',
    'required_with'        => 'الحقل :attribute مطلوب عندما يكون :values موجوداً.',
    'required_with_all'    => 'الحقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without'     => 'الحقل :attribute مطلوب عندما لا يكون :values موجوداً.',
    'required_without_all' => 'الحقل :attribute مطلوب عندما لا يكون أي من :values موجوداً.',
    'same'                 => 'يجب أن يتطابق الحقل :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن يكون الحقل :attribute بحجم :size.',
        'file'    => 'يجب أن يكون حجم الحقل :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي الحقل :attribute على :size حرفاً.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على :size عناصر.',
    ],
    'starts_with'          => 'يجب أن يبدأ الحقل :attribute بأحد القيم التالية: :values.',
    'string'               => 'يجب أن يكون الحقل :attribute سلسلة نصية.',
    'timezone'             => 'يجب أن يكون الحقل :attribute منطقة زمنية صالحة.',
    'unique'               => 'تم استخدام الحقل :attribute مسبقاً.',
    'uploaded'             => 'فشل تحميل الحقل :attribute.',
    'url'                  => 'يجب أن يكون الحقل :attribute عنوان URL صالحاً.',
    'uuid'                 => 'يجب أن يكون الحقل :attribute UUID صالحاً.',

    /*
    |--------------------------------------------------------------------------
    | رسائل التحقق المخصصة
    |--------------------------------------------------------------------------
    |
    | يمكنك هنا تحديد رسائل تحقق مخصصة للحقول باستخدام الصيغة "attribute.rule"
    | لتسمية الرسائل. يتيح لك ذلك تخصيص رسالة لكل قاعدة بسهولة.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | الحقول المخصصة للتحقق
    |--------------------------------------------------------------------------
    |
    | تُستخدم الأسطر التالية لاستبدال الاسم الافتراضي للحقل بشيء أكثر وضوحاً،
    | مثل استبدال "email" بـ "البريد الإلكتروني".
    | هذا يساعد على جعل الرسائل أكثر تعبيراً.
    |
    */

    'attributes' => [],

];
