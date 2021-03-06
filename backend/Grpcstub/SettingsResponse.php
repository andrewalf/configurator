<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: stub_services/grpc.proto

namespace Grpcstub;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>grpcstub.SettingsResponse</code>
 */
class SettingsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .grpcstub.Setting settings = 1;</code>
     */
    private $settings;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Grpcstub\Setting[]|\Google\Protobuf\Internal\RepeatedField $settings
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\StubServices\Grpc::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .grpcstub.Setting settings = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Generated from protobuf field <code>repeated .grpcstub.Setting settings = 1;</code>
     * @param \Grpcstub\Setting[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSettings($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Grpcstub\Setting::class);
        $this->settings = $arr;

        return $this;
    }

}

