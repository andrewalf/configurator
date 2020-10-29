const messages = require('./grpc_pb');
const services = require('./grpc_grpc_pb');
const grpc = require('grpc');

const port = 8000;

/**
 * Для хранения опций, вместо какого-то персистентного хранилища
 */
const settings = [
    {
        'name': 'grpc_setting_1',
        'type': 'int',
        'value': 0,
    },
    {
        'name': 'grpc_setting_2',
        'type': 'string',
        'value': '',
    },
    {
        'name': 'grpc_setting_3',
        'type': 'bool',
        'value': true,
    },
];

function GetSettings(call, callback) {
    const reply = new messages.SettingsResponse();
    reply.setSettingsList(getProtoSettings())
    callback(null, reply);
}

function SetSetting(call, callback) {
    // TODO implement
}

function getProtoSettings() {
    const rs = [];

    for (const setting of settings) {
        const optionMessage = new messages.Setting();
        optionMessage.setName(setting.name);
        optionMessage.setType(setting.type);
        optionMessage.setValue(setting.value);
        res.push(optionMessage);
    }

    return res;
}

const server = new grpc.Server();
server.addService(services.GrpcStubService, {getSettings: GetSettings});
server.addService(services.GrpcStubService, {setSetting: SetSetting});
server.bind(`localhost:${port}`, grpc.ServerCredentials.createInsecure());
server.start();