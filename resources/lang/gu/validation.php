<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'આ :attribute સ્વીકારવી આવશ્યક છે.',
    'accepted_if' => 'જ્યારે :other :value હોય ત્યારે :attribute સ્વીકારવી આવશ્યક છે',
    'active_url' => 'આ :attribute માન્ય URL નથી.',
    'after' => ':attribute :date પછીની તારીખ હોવી જોઈએ.',
    'after_or_equal' => ':attribute :date પછીની અથવા તેની બરાબરની તારીખ હોવી જોઈએ.',
    'alpha' => ':attribute માં માત્ર અક્ષરો હોવા જોઈએ.',
    'alpha_dash' => ':attribute માં માત્ર અક્ષરો, સંખ્યાઓ, ડેશ અને અન્ડરસ્કોર હોવા જોઈએ.',
    'alpha_num' => ':attribute: માં માત્ર અક્ષરો અને સંખ્યાઓ હોવા જોઈએ',
    'array' => 'આ :attribute એરે હોવી જોઈએ.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => ':attribute :date પહેલાની અથવા સમાન તારીખ હોવી જોઈએ.',
    'between' => [
        'numeric' => 'આ :attribute :min અને :max ની વચ્ચે હોવી જોઈએ.',
        'file' => ':attribute :min અને :max kilobytes ની વચ્ચે હોવી જોઈએ.',
        'string' => ':attribute :min અને :max અક્ષરોની વચ્ચે હોવી જોઈએ.',
        'array' => ':attribute માં :min અને :max આઇટમ્સ વચ્ચે હોવી આવશ્યક છે.',
    ],
    'boolean' => ':attribute ફીલ્ડ સાચું કે ખોટું હોવું જોઈએ.',
    'confirmed' => 'આ :attribute પુષ્ટિ મેળ ખાતી નથી.',
    'current_password' => 'પાસવર્ડ ખોટો છે.',
    'date' => ':attribute માન્ય તારીખ નથી.',
    'date_equals' => ':attribute તારીખ :date ની બરાબર હોવી જોઈએ.',
    'date_format' => ':attribute ફોર્મેટ :format સાથે મેળ ખાતી નથી.',
    'declined' => ':attribute નકારવું જ જોઈએ.',
    'declined_if' => 'જ્યારે :other :value હોય ત્યારે :attribute નકારવી જોઈએ.',
    'different' => ':attribute અને :other અલગ હોવા જોઈએ.',
    'digits' => ':attribute :digits અંકો હોવા જોઈએ.',
    'digits_between' => ':attribute :min અને :max અંકોની વચ્ચે હોવી જોઈએ.',
    'dimensions' => ':attribute માં અમાન્ય ઇમેજ પરિમાણો છે.',
    'distinct' => ':attribute ફીલ્ડમાં ડુપ્લિકેટ મૂલ્ય છે.',
    'email' => ':attribute એ માન્ય ઇમેઇલ સરનામું હોવું જોઈએ.',
    'ends_with' => ':attribute નીચેનામાંથી એક સાથે સમાપ્ત થવો જોઈએ: :values.',
    'enum' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'exists' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'file' => ':attribute એ ફાઇલ હોવી જોઈએ.',
    'filled' => ':attribute ફીલ્ડમાં મૂલ્ય હોવું આવશ્યક છે.',
    'gt' => [
        'numeric' => ':attribute :value કરતાં મોટી હોવી જોઈએ.',
        'file' => ':attribute :value kilobytes કરતાં મોટી હોવી જોઈએ.',
        'string' => ':attribute :value અક્ષરો કરતાં મોટી હોવી જોઈએ.',
        'array' => ':attribute માં :value વસ્તુઓ કરતાં વધુ હોવી જોઈએ.',
    ],
    'gte' => [
        'numeric' => ':attribute :value કરતાં મોટી અથવા સમાન હોવી જોઈએ.',
        'file' => ':attribute :value કિલોબાઈટ કરતાં મોટી અથવા બરાબર હોવી જોઈએ.',
        'string' => ':attribute :value અક્ષરો કરતાં મોટી અથવા સમાન હોવી જોઈએ.',
        'array' => ':attribute માં :value વસ્તુઓ અથવા વધુ હોવી જોઈએ.',
    ],
    'image' => ':attribute એક છબી હોવી જોઈએ.',
    'in' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'in_array' => ':attribute ફીલ્ડ :other માં અસ્તિત્વમાં નથી.',
    'integer' => ':attribute પૂર્ણાંક હોવું આવશ્યક છે.',
    'ip' => ':attribute એ માન્ય IP સરનામું હોવું જોઈએ.',
    'ipv4' => ':attribute એ માન્ય IPv4 સરનામું હોવું જોઈએ.',
    'ipv6' => ':attribute એ માન્ય IPv6 સરનામું હોવું જોઈએ.',
    'json' => ':attribute એ માન્ય JSON સ્ટ્રિંગ હોવી જોઈએ.',
    'lt' => [
        'numeric' => ':attribute :value કરતાં ઓછું હોવું જોઈએ.',
        'file' => ':attribute :value kilobytes કરતાં ઓછી હોવી જોઈએ.',
        'string' => ':attribute :value અક્ષરો કરતાં ઓછી હોવી જોઈએ.',
        'array' => ':attributeમાં :value વસ્તુઓ કરતાં ઓછી હોવી જોઈએ.',
    ],
    'lte' => [
        'numeric' => ':attribute :value કરતાં ઓછી અથવા બરાબર હોવી જોઈએ.',
        'file' => ':attribute :value kilobytes કરતાં ઓછી અથવા બરાબર હોવી જોઈએ.',
        'string' => ':attribute :value અક્ષરો કરતાં ઓછી અથવા બરાબર હોવી જોઈએ.',
        'array' => ':attributeમાં :value વસ્તુઓ કરતાં વધુ ન હોવી જોઈએ.',
    ],
    'mac_address' => ':attribute એ માન્ય MAC સરનામું હોવું જોઈએ.',
    'max' => [
        'numeric' => ':attribute :max કરતાં મોટી ન હોવી જોઈએ.',
        'file' => ':attribute :max કિલોબાઈટથી વધુ ન હોવી જોઈએ.',
        'string' => ':attribute :max અક્ષરો કરતાં મોટી ન હોવી જોઈએ.',
        'array' => ':attribute માં :max થી વધુ વસ્તુઓ ન હોવી જોઈએ.',
    ],
    'mimes' => ':attribute પ્રકાર :values ​​ની ફાઇલ હોવી આવશ્યક છે.',
    'mimetypes' => ':attribute પ્રકાર :values ​​ની ફાઇલ હોવી આવશ્યક છે.',
    'min' => [
        'numeric' => 'આ :attribute ઓછામાં ઓછી :min હોવી જોઈએ.',
        'file' => 'આ :attribute ઓછામાં ઓછું :min kilobytes હોવી જોઈએ.',
        'string' => 'આ :attribute ઓછામાં ઓછા :min અક્ષરોની હોવી જોઈએ.',
        'array' => ':attributeમાં ઓછામાં ઓછી :min આઇટમ હોવી આવશ્યક છે.',
    ],
    'multiple_of' => ':attribute :value નો ગુણાંક હોવો જોઈએ.',
    'not_in' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'not_regex' => ':attribute ફોર્મેટ અમાન્ય છે.',
    'numeric' => ':attribute સંખ્યા હોવી જોઈએ.',
    'password' => 'પાસવર્ડ ખોટો છે.',
    'present' => ':attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'prohibited' => ':attribute ફીલ્ડ પ્રતિબંધિત છે.',
    'prohibited_if' => ':attribute ફીલ્ડ પ્રતિબંધિત છે જ્યારે :other :value.',
    'prohibited_unless' => ':attribute ફીલ્ડ પ્રતિબંધિત છે સિવાય કે :other :values ​​માં હોય.',
    'prohibits' => ':attribute ફીલ્ડ :other હાજર રહેવાથી પ્રતિબંધિત કરે છે.',
    'regex' => ':attribute ફોર્મેટ અમાન્ય છે.',
    'required' => 'આ :attribute ફીલ્ડ જરૂરી છે.',
    'required_array_keys' => ':attribute ફીલ્ડમાં :values ​​માટેની એન્ટ્રીઓ હોવી જોઈએ.',
    'required_if' => ':attribute ફીલ્ડ જરૂરી છે જ્યારે :other છે :value.',
    'required_unless' => ':attribute ફીલ્ડ જરૂરી છે સિવાય કે :other :values ​​માં હોય.',
    'required_with' => 'જ્યારે :values ​​હાજર હોય ત્યારે :attribute ફીલ્ડ જરૂરી છે.',
    'required_with_all' => 'જ્યારે :values હાજર હોય ત્યારે :attribute ફીલ્ડ જરૂરી છે.',
    'required_without' => 'જ્યારે :values ​​હાજર ન હોય ત્યારે :attribute ફીલ્ડ જરૂરી છે.',
    'required_without_all' => 'જ્યારે :values માંથી કોઈ હાજર ન હોય ત્યારે :attribute ફીલ્ડ જરૂરી છે.',
    'same' => ':attribute અને :other મેળ ખાતું હોવું જોઈએ.',
    'size' => [
        'numeric' => ':attribute :size હોવી જોઈએ.',
        'file' => ':attribute :size કિલોબાઈટ હોવી જોઈએ.',
        'string' => ':attribute :size અક્ષરો હોવા જોઈએ.',
        'array' => ':attribute માં :size વસ્તુઓ હોવી જોઈએ.',
    ],
    'starts_with' => ':attribute નીચેનામાંથી એકથી શરૂ થવું જોઈએ: :મૂલ્યો.',
    'string' => ':attribute શબ્દમાળા હોવી જોઈએ.',
    'timezone' => ':attribute એ માન્ય ટાઈમઝોન હોવું જોઈએ.',
    'unique' => 'આ :attribute પહેલેથી જ લેવામાં આવી છે.',
    'uploaded' => ':attribute અપલોડ કરવામાં નિષ્ફળ.',
    'url' => ':attribute એ માન્ય URL હોવું આવશ્યક છે.',
    'uuid' => ':attribute એ માન્ય UUID હોવું જોઈએ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
];
