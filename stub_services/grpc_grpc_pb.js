// GENERATED CODE -- DO NOT EDIT!

'use strict';
var grpc = require('grpc');
var stub_services_grpc_pb = require('./grpc_pb.js');
var google_protobuf_any_pb = require('google-protobuf/google/protobuf/any_pb.js');
var google_protobuf_empty_pb = require('google-protobuf/google/protobuf/empty_pb.js');

function serialize_google_protobuf_Empty(arg) {
  if (!(arg instanceof google_protobuf_empty_pb.Empty)) {
    throw new Error('Expected argument of type google.protobuf.Empty');
  }
  return Buffer.from(arg.serializeBinary());
}

function deserialize_google_protobuf_Empty(buffer_arg) {
  return google_protobuf_empty_pb.Empty.deserializeBinary(new Uint8Array(buffer_arg));
}

function serialize_grpcstub_SetSettingRequest(arg) {
  if (!(arg instanceof stub_services_grpc_pb.SetSettingRequest)) {
    throw new Error('Expected argument of type grpcstub.SetSettingRequest');
  }
  return Buffer.from(arg.serializeBinary());
}

function deserialize_grpcstub_SetSettingRequest(buffer_arg) {
  return stub_services_grpc_pb.SetSettingRequest.deserializeBinary(new Uint8Array(buffer_arg));
}

function serialize_grpcstub_SetSettingResponse(arg) {
  if (!(arg instanceof stub_services_grpc_pb.SetSettingResponse)) {
    throw new Error('Expected argument of type grpcstub.SetSettingResponse');
  }
  return Buffer.from(arg.serializeBinary());
}

function deserialize_grpcstub_SetSettingResponse(buffer_arg) {
  return stub_services_grpc_pb.SetSettingResponse.deserializeBinary(new Uint8Array(buffer_arg));
}

function serialize_grpcstub_SettingsResponse(arg) {
  if (!(arg instanceof stub_services_grpc_pb.SettingsResponse)) {
    throw new Error('Expected argument of type grpcstub.SettingsResponse');
  }
  return Buffer.from(arg.serializeBinary());
}

function deserialize_grpcstub_SettingsResponse(buffer_arg) {
  return stub_services_grpc_pb.SettingsResponse.deserializeBinary(new Uint8Array(buffer_arg));
}


var GrpcStubService = exports.GrpcStubService = {
  getSettings: {
    path: '/grpcstub.GrpcStub/GetSettings',
    requestStream: false,
    responseStream: false,
    requestType: google_protobuf_empty_pb.Empty,
    responseType: stub_services_grpc_pb.SettingsResponse,
    requestSerialize: serialize_google_protobuf_Empty,
    requestDeserialize: deserialize_google_protobuf_Empty,
    responseSerialize: serialize_grpcstub_SettingsResponse,
    responseDeserialize: deserialize_grpcstub_SettingsResponse,
  },
  setSetting: {
    path: '/grpcstub.GrpcStub/SetSetting',
    requestStream: false,
    responseStream: false,
    requestType: stub_services_grpc_pb.SetSettingRequest,
    responseType: stub_services_grpc_pb.SetSettingResponse,
    requestSerialize: serialize_grpcstub_SetSettingRequest,
    requestDeserialize: deserialize_grpcstub_SetSettingRequest,
    responseSerialize: serialize_grpcstub_SetSettingResponse,
    responseDeserialize: deserialize_grpcstub_SetSettingResponse,
  },
};

exports.GrpcStubClient = grpc.makeGenericClientConstructor(GrpcStubService);
