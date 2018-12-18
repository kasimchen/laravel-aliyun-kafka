## 安装 librdkafka

    git clone https://github.com/edenhill/librdkafka.git     
    cd librdkafka && ./configure && make && make install

## 安装 php-rdkafka

    pecl install rdkafka    
    add extension=rdkafka.so to your php.ini
   
##  安装 laravel-kafka
   
    composer require onemena/laravel-aliyun-kafka:dev-master
    // config/app.php    
    \LaravelAliYunKafka\LaravelKafkaServiceProvider::class
    // config/queue.php
    'kafka' => [
        'driver' => 'kafka',
        'sasl'=>env('KAFKA_SASL',true),
        'security.protocol'=>env('KAFKA_SECURITY_PROTOCOL','SASL_SSL'),
        // your appkey
        'sasl_plain_username' => env('KAFKA_SASL_PLAIN_USERNAME', 'aliyun_user_name'),
        //your app_secret 后10位
        'sasl_plain_password' => env('KAFKA_SASL_PLAIN_PASSWORD', 'aliyun_password'),
        // 初始化服务器
        'bootstrap_servers' => env('KAFKA_BOOTSTRAP_SERVERS', 'kafka-ons-internet.aliyun.com:8080'),
        'queue' => env('KAFKA_QUEUE', 'default'),
        'ssl.ca.location' => storage_path('config/ca-cert'), // cr 证书 下载 https://help.aliyun.com/document_detail/52376.html
        // 最大尝试次数
        'max.tries' => '5',
        // 消费者ID
        'consumer_id' => ENV('KAFKA_CONSUMER_ID', 'your consumer id'),
        'log_level' => LOG_DEBUG， // 日志等级
         'message.send.max.retries' => 5, 
    ],
    
### 使用方法:  
   php artisan queue:work kafka --tries=3