<?php

namespace Sjje\LaravelKafka;

use Illuminate\Support\ServiceProvider;
use Sjje\LaravelKafka\Connectors\KafkaConnector;
use Illuminate\Support\Facades\Queue;

class LaravelKafkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Queue::extend('kafka', function (){
            return new KafkaConnector;
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                KafkaQueueCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/kafka.php', 'queue.connections.kafka'
        );

//        $this->app->bind('kafka.topic_conf', function () {
//            return new \RdKafka\TopicConf();
//        });
//
//        $this->app->bind('kafka.producer', function () {
//            return new \RdKafka\Producer();
//        });
//
//        $this->app->bind('kafka.conf', function () {
//            return new \RdKafka\Conf();
//        });
//
//        $this->app->bind('kafka.consumer', function () {
//            return new \RdKafka\KafkaConsumer();
//        });
    }
}
