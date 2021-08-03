    <?php
    $access_token = 'EAAig8f3fftkBAMWxSsEqIQoWLzgLhJAfQNPnZAgoZCudZBNGUhJxyF9UcgVk7mwHZB1R4hFeuDBx5YgLOwX68fwsg44hRjXxZBRhZAfZCG8ztabW4Quqq8dZB6QLEGL209RNJwigrZCL5lHR4OZAKCQqF6jXmMxey1dh2oLYhnfA1xZAf4Y1IXu0UG9'; 
    $messageJSON =  '{    
      "messages":[
        {
        "text": "برطمان لتسكنوا ١٤٤٠-٢٠١٩ 🌟\n\nبرطمان السنة دي مختلف عن أي برطمان عملناه قبل كده.. 😍\n\nلتسكنوا بيهتم بالعلاقات والمعاملات مع الناس اللي بنحبهم وبيشاركونا حياتنا وأنها تقوم على أخلاق وقيم النبي وأهل بيته، وخصوصا أن #رمضان شهر البركة والمحبة ولمة العيلة، وإزاي ممكن تستخدمه \n\nيكون ليه أثر جميل على كل أهل البيت❤ \n\n📌هتجيبه هدية لمين😉؟  \n\nلتسكنوا أفضل هدية في رمضان لشريك حياتك والmarried couples  وأهل بيتك، هتستخدمه مع الناس اللي بتحبها❤ \n\n📌البرطمان هيكون معاه إيه 🤔؟ \n\nهدايا ومفاجآت كتير السنة دي 😍 \n\n🔵٧٠ ورقة مكتوبة بخط اليد  \n\n🔵برواز خشب مقاس ١٠*١٠ سم  \n\n🔵٤ رسائل فاضية اكتب رسالتك بنفسك \n\n🔵لوحة تعليق الرسائل في البيت  \n\n 🔵بوكس بيت كرتون  \n\n #رمضان_أحلى \n\n #رمضان١٤٤٠ \n\n #ramadan2019"
      }
      ]
    }';
      
    //API Url
    $api_url = 'https://graph.facebook.com/v3.2/me/message_creatives?access_token='.$access_token;
      
    //Initiate cURL.
    $ch = curl_init($api_url);
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);  
    // Return the API response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $messageJSON);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //Execute the request
    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);
    // Get Message Creative Id
    $response = json_decode($result);
    $message_creative_id = $response->message_creative_id;
    ?>

