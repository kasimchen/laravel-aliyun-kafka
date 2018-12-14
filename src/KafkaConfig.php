<?php
namespace Sjje\LaravelKafka;
use RdKafka\Conf;

class KafkaConfig
{

    /*
     * 初始化配置 for aliyun
     */
    public function bootstrapConfig($config)
    {
        $conf = new Conf();

        if (isset($config['sasl'])&&$config['sasl']==true) {
            $conf->set('sasl.mechanisms', 'PLAIN');
            $conf->set('sasl.username', $config['sasl_plain_username']);
            $conf->set('sasl.password', $config['sasl_plain_password']);
            $conf->set('ssl.ca.location', $config['ssl.ca.location']);
        }

        $conf->set('security.protocol', $config['security.protocol']);
        $conf->set('api.version.request', 'true');
        $conf->set('message.send.max.retries', $config['message.send.max.retries']);
        $conf->set('group.id', $config['consumer_id']);
        $conf->set('enable.auto.commit', 'false');   // 不自动提交
        $conf->set('offset.store.method', 'broker'); // offset保存在broker上
        $conf->set('metadata.broker.list', $config['bootstrap_servers']);
        return $conf;
    }


}