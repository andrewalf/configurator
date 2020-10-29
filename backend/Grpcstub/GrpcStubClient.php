<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Grpcstub;

/**
 */
class GrpcStubClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetSettings(\Google\Protobuf\GPBEmpty $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/grpcstub.GrpcStub/GetSettings',
        $argument,
        ['\Grpcstub\SettingsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Grpcstub\SetSettingRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function SetSetting(\Grpcstub\SetSettingRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/grpcstub.GrpcStub/SetSetting',
        $argument,
        ['\Grpcstub\SetSettingResponse', 'decode'],
        $metadata, $options);
    }

}
