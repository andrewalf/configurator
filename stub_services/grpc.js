const messages = require('./grpc_pb');
const services = require('./grpc_grpc_pb');
const grpc = require('grpc');

const port = 8000;

/**
 * Для хранения опций, вместо какого-то персистентного хранилища
 */
const options = [
    {
        'name': 'grpc_option_1',
        'type': 'int',
        'value': 0,
    },
    {
        'name': 'grpc_option_2',
        'type': 'string',
        'value': '',
    },
    {
        'name': 'grpc_option_3',
        'type': 'bool',
        'value': true,
    },
];

function GetSettings(call, callback) {
    const reply = new messages.SettingsResponse();
    reply.setSettingsList(protoOptions())
    callback(null, reply);
}

function SetSetting(call, callback) {
    // TODO implement
}

function protoOptions() {
    const res = [];

    for (const option of options) {
        const optionMessage = new messages.Setting();
        optionMessage.setName(option.name);
        optionMessage.setType(option.type);
        optionMessage.setValue(option.value);
        res.push(optionMessage);
    }

    return res;
}

const server = new grpc.Server();
server.addService(services.GrpcStubService, {getSettings: GetSettings});
server.addService(services.GrpcStubService, {setSetting: SetSetting});
server.bind(`localhost:${port}`, grpc.ServerCredentials.createInsecure());
server.start();